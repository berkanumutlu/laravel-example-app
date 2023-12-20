<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserEditRequest;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->data['records'] = User::query()->select([
            'id', 'name', 'email', 'username', 'image', 'title', 'description', 'status', 'created_at'
        ])->orderBy('id', 'desc')->get();
        $this->data['columns'] = [
            'Id', 'Image', 'Name', 'Email', 'Username', 'Title', 'Description', 'Status', 'Creation Time', 'Actions'
        ];
        $this->data['title'] = 'User List';
        return view('admin.user.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->data['title'] = 'Add User';
        return view('admin.user.add-edit', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = !empty($request->username) ? Str::slug($request->username) : Str::slug($request->name);
        $user->password = bcrypt($request->password);
        $user->title = $request->title;
        $user->description = $request->description;
        try {
            $user->save();
            if ($request->file('image')) {
                $folder = 'users';
                $public_path = 'storage/'.$folder;
                $image_file = $request->file('image');
                $image_original_extension = $image_file->getClientOriginalExtension();
                $image_file_name = $user->id.'.'.$image_original_extension;
                $image_file_path = public_path($public_path.'/'.$image_file_name);
                try {
                    $image_file->storeAs($folder, $image_file_name);
                    User::query()->where('id', $user->id)->update(['image' => $public_path.'/'.$image_file_name]);
                } catch (\Exception $e) {

                }
            }
        } catch (\Exception $e) {
            if (isset($image_file_path) && file_exists($image_file_path)) {
                File::delete($image_file_path);
            }
            alert()->error("Error", "User could not be added.")->showConfirmButton("OK");
            return redirect()->back()->exceptInput("_token", "files", "image", "password");
        }
        alert()->success("Success", "User successfully added.")->showConfirmButton("OK")->autoClose(5000);
        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserEditRequest $request)
    {
        $id = $request->id;
        $this->data['title'] = 'User #'.$id.' Edit';
        $user = User::where('id', $id)->first();
        if (is_null($user)) {
            alert()->error("Error", "User not found.")->showConfirmButton("OK");
            return redirect()->route('admin.user.index');
        }
        $this->data['record'] = $user;
        return view('admin.user.add-edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $username = Str::slug($request->username);
        $slug_check = $this->check_username(User::class, $username);
        $user = User::find($id);
        $user_image = $user->image;
        if (is_null($slug_check) || (!is_null($slug_check) && $slug_check->id == $user->id)) {
            $user->username = $username;
        } else {
            $user->username = Str::slug($username.'-'.random_int(1, 9999));
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->title = $request->title;
        $user->description = $request->description;
        if (!is_null($request->password)) {
            $user->password = bcrypt($request->password);
        }
        try {
            $user->save();
            if ($request->file('image')) {
                $folder = 'users';
                $public_path = 'storage/'.$folder;
                $image_file = $request->file('image');
                $image_original_extension = $image_file->getClientOriginalExtension();
                $image_file_name = $user->id.'.'.$image_original_extension;
                try {
                    $image_file->storeAs($folder, $image_file_name);
                    User::query()->where('id', $id)->update(['image' => $public_path.'/'.$image_file_name]);
                    if (file_exists(public_path($user_image))) {
                        File::delete(public_path($user_image));
                    }
                } catch (\Exception $e) {

                }
            }
        } catch (\Exception $e) {
            //abort(500, $e->getMessage());
            alert()->error("Error", "User could not be updated.")->showConfirmButton("OK");
            return redirect()->back()->exceptInput("_token", "files", "image", "password");
        }
        alert()->success("Success", "User has been updated successfully.")
            ->showConfirmButton("OK")->autoClose(5000);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function change_status(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = ['status' => false, 'message' => null];
        $validator = Validator::make($request->all(), [
            'id'   => ['required', 'integer', 'exists:users'],
            'type' => ['required', 'string', Rule::in(['status'])]
        ]);
        if ($validator->fails()) {
            $response['message'] = collect($validator->errors()->all())->implode('<br>');
            $response['notify'] = [
                'message' => $response['message'],
                'icon'    => 'info'
            ];
            return response()->json($response);
        }
        $record_id = $request->id;
        $user = User::where("id", $record_id)->first();
        if (!empty($user)) {
            try {
                $type = $request->type;
                $record_type = $user->$type;
                $old_status_text = $record_type ? 'Active' : 'Passive';
                $user->$type = !$record_type;
                $user->save();
                $record_type = $user->$type;
                $new_status_text = $record_type ? 'Active' : 'Passive';
                $response['status'] = true;
                $response['message'] = "User(<strong>".$user->name."</strong>) <strong>".$request->typeText."</strong> value changed <strong>".$old_status_text."</strong> to <strong>".$new_status_text."</strong>.";
                $response['data'] = [
                    'recordStatus'     => $record_type,
                    'recordStatusText' => $new_status_text
                ];
                $response['notify'] = [
                    'message' => $response['message'],
                    'icon'    => 'success',
                    'timer'   => 4000
                ];
            } catch (\Exception $e) {
                $response['message'] = $e->getMessage();
                $response['notify'] = [
                    'message' => "Could not change.",
                    'icon'    => 'error'
                ];
            }
        } else {
            $response['message'] = "User not found.";
            $response['notify'] = [
                'message' => $response['message'],
                'icon'    => 'error'
            ];
        }
        return response()->json($response);
    }
}
