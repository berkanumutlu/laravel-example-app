<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserStoreRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        $title = 'Register';
        return view('web.register.index', compact(['title']));
    }

    public function store(UserStoreRequest $request)
    {
        $user = new User();
        $user->name = $request->first_name.' '.$request->last_name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->status = 0;
        try {
            $user->save();
        } catch (\Exception $e) {
            alert()->error("Error", "An error occurred while registering.")->showConfirmButton("OK");
            return redirect()->back()->exceptInput("_token", "password", "password_confirmation");
        }
        alert()->success("Success", "You have successfully registered. You can log in after administrator approval.")
            ->showConfirmButton("OK");
        return redirect()->route('web.register.index');
    }
}
