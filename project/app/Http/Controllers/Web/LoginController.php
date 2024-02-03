<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LoginRequest;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
        //$user = User::query()->where("email", $email)->withTrashed()->first();
        $user = User::query()->where("email", $email)->first();
        if (!empty($user)) {
            if ($user->deleted_at) {
                return redirect()->route('login.index')->withErrors([
                    "deleted_at" => "Your account has been blocked."
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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        $response = ['status' => false, 'message' => null];
        if (Auth::guard('web')->check()) {
            try {
                Auth::guard('web')->logout();
                //$request->session()->invalidate();
                //$request->session()->regenerate();
                $response['status'] = true;
                $response['refreshPage'] = true;
            } catch (\Exception $e) {
                $response['message'] = 'An error occurred while logging out.';
            }
        }
        return response()->json($response);
    }

    public function reset_password_show()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('home');
        }
        return view('web.login.reset-password');
    }

    public function reset_password(Request $request)
    {
        $email = $request->email;
        $user = User::query()->where('email', $email)->first();
        if (!empty($user)) {
            if ($user->deleted_at) {
                return redirect()->back()->withErrors([
                    "deleted_at" => "Your account has been blocked."
                ])->onlyInput("email");
            }
            if ($user->status != 1) {
                return redirect()->back()->withErrors([
                    "status" => "Your account has not been approved."
                ])->onlyInput("email");
            }
            $token_exist = DB::table('password_reset_tokens')->where('email', $email)->first();
            if ($token_exist) {
                $token = $token_exist->token;
            } else {
                $token = Str::random(60);
                DB::table("password_reset_tokens")->insert([
                    'email'      => $email,
                    'token'      => $token,
                    'created_at' => now()
                ]);
            }
            Mail::to($user->email)->send(new ResetPasswordMail($user, $token));
            alert()->success("Success",
                "Your password has been reset. Follow the instructions in the e-mail sent to your e-mail address.")
                ->showConfirmButton("OK");
            return redirect()->back();
        }
        return redirect()->back()->withErrors([
            "email" => "Email not found."
        ])->onlyInput("email");
    }
}
