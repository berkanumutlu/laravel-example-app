<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        $title = 'Login';
        return view('web.login.index', compact(['title']));
    }

    public function login(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember_me = isset($request->remember_me);
        $user = User::query()->where("email", $email)->first();
        if (!empty($user)) {
            if ($user->deleted_at) {
                return redirect()->route('login.index')->withErrors([
                    "status" => "Your account has been blocked."
                ])->onlyInput("email", "remember_me");
            }
            if ($user->status != 1) {
                return redirect()->route('login.index')->withErrors([
                    "status" => "Your account has not been approved."
                ])->onlyInput("email", "remember_me");
            }
            if (Hash::check($password, $user->password)) {
                Auth::guard('web')->login($user, $remember_me);
                return redirect()->route('home');
            }
        }
        return redirect()->route('login.index')->withErrors([
            "email" => "Email or password is incorrect."
        ])->onlyInput("email", "remember_me");
    }
}
