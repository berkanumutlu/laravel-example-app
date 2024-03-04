<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserUpdatePasswordRequest;
use App\Http\Requests\Web\UserUpdateRequest;
use App\Models\User;
use App\Traits\Loggable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use Loggable;

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::guard('web')->user();
        $title = 'User Profile';
        return view('web.user.index', compact(['title', 'user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $user_image = $user->image;
        //TODO: Kullanıcıya ait article listesi urlsi de değişeceği için eski username yeni username'e url redirect yapılması gerek.
        $user->username = Str::slug($request->username);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->title = $request->title;
        $user->description = $request->description;
        try {
            $user->save();
            if ($request->file('image')) {
                $folder = 'users';
                $public_path = 'storage/'.$folder;
                $image_file = $request->file('image');
                $image_original_extension = $image_file->getClientOriginalExtension();
                $image_file_name = $user->username.'.'.$image_original_extension;
                $image_new = $public_path.'/'.$image_file_name;
                try {
                    $image_file->storeAs($folder, $image_file_name);
                    User::query()->where('id', $id)->update(['image' => $image_new]);
                    if (file_exists(public_path($user_image))) {
                        File::delete(public_path($user_image));
                    }
                } catch (\Exception $e) {
                    //TODO: Hata loglanmalı
                }
            } elseif ($request->image_file_deleted == 1 && !empty($user_image)) {
                try {
                    User::query()->where('id', $id)->update(['image' => null]);
                    if (file_exists(public_path($user_image))) {
                        File::delete(public_path($user_image));
                    }
                } catch (\Exception $e) {
                    //TODO: Hata loglanmalı
                }
            }
        } catch (\Exception $e) {
            alert()->error("Error", "Your information could not be saved.")->showConfirmButton("OK");
            return redirect()->back()->exceptInput("_token", "files", "image");
        }
        alert()->success("Success", "Your information has been updated successfully.")
            ->showConfirmButton("OK")->autoClose(5000);
        return redirect()->back();
    }

    public function show_change_password()
    {
        $user = Auth::guard('web')->user();
        $title = 'Change Password';
        return view('web.user.change-password', compact(['title', 'user']));
    }

    public function update_password(UserUpdatePasswordRequest $request, User $user)
    {
        if (!Hash::check($request->current_password, $user->password)) {
            alert()->error("Error", "The current password is incorrect.")->showConfirmButton("OK");
            return redirect()->back()->onlyInput();
        }
        try {
            $user->password = Hash::make($request->new_password);
            $user->save();
            $this->log('logout', $user, $user->id);
            Auth::guard('web')->logout();
        } catch (\Exception $e) {
            alert()->error("Error", "Your password could not be saved.")->showConfirmButton("OK");
            return redirect()->back()->onlyInput();
        }
        alert()->success("Success", "Your password has been updated successfully.")
            ->showConfirmButton("OK")->autoClose(5000);
        return redirect()->route('login.index')->onlyInput();
    }
}