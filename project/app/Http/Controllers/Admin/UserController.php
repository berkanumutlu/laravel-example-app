<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
