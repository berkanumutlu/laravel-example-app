<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends BaseController
{
    public function index()
    {
        $favicon = asset('assets/auth/images/neptune.png');
        $title = 'Login';
        return view('admin.login.index', compact(['favicon', 'title']));
    }

    public function login(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember_me = isset($request->remember_me);
        //$user = User::where("email", $email)->first();
        //$user = User::where("email", $email)->where("status", 1)->first();
        /*if (Auth::attempt(['email' => $email, 'password' => $password], $remember_me)) {
            return redirect()->route('admin.dashboard');
        }*/
        /*if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1], $remember_me)) {
            return redirect()->route("admin.index");
        }*/
        /*if (!empty($user) && Hash::check($password, $user->password)) {
            Auth::login($user, $remember_me);
            //Auth::loginUsingId($user->id, $remember_me);
            return redirect()->route('admin.dashboard');
        }*/
        /*if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], $remember_me)) {
            return redirect()->route('admin.dashboard');
        }*/
        $admin = Admin::query()->where("email", $email)->withTrashed()->first();
        if (!empty($admin)) {
            if ($admin->deleted_at) {
                return redirect()->route('admin.login.index')->withErrors([
                    "deleted_at" => "Your account has been blocked."
                ])->onlyInput("email", "remember_me");
            }
            if ($admin->status != 1) {
                return redirect()->route('admin.login.index')->withErrors([
                    "status" => "Your account has not been approved."
                ])->onlyInput("email", "remember_me");
            }
            if (Hash::check($password, $admin->password)) {
                Auth::guard('admin')->login($admin, $remember_me);
                //Auth::guard('admin')->loginUsingId($admin->id, $remember_me);
                return redirect()->route('admin.dashboard');
            }
        }
        return redirect()->route('admin.login.index')->withErrors([
            "email" => "Email or password is incorrect."
        ])->onlyInput("email", "remember_me");
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        $result = ['status' => false, 'message' => null];
        if (Auth::guard('admin')->check()) {
            try {
                Auth::guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerate();
                $result['status'] = true;
                $result['redirect'] = route('admin.login.index');
            } catch (\Exception $e) {
                $result['message'] = $e->getMessage();
            }
        }
        //return redirect()->route('admin.login.index');
        return response()->json($result);
    }
}
