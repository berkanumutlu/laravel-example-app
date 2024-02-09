<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LoginRequest;
use App\Http\Requests\Web\PasswordResetRequest;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use App\Traits\Loggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use Loggable;

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
                \Illuminate\Support\Facades\Log::notice("User login:".$user->name, $user->toArray());
                $this->log('login_user', $user, $user->id, $user->toArray());
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
                $this->log('logout_user', User::class, \auth()->id(), \auth()->user()->toArray());
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
            if ($token_exist && now()->diffInHours($token_exist->created_at) < 2) {
                alert()->info("Info", "A reset email has been sent before. You can try again in a few hours.")
                    ->showConfirmButton("OK");
            } else {
                Mail::to($user->email)->send(new ResetPasswordMail($user, $token));
                $this->log('password_reset_mail_send', $user, $user->id, $user->toArray());
                alert()->success("Success",
                    "Your password has been reset. Follow the instructions in the e-mail sent to your e-mail address.")
                    ->showConfirmButton("OK");
            }
            return redirect()->back();
        }
        return redirect()->back()->withErrors([
            "email" => "Email not found."
        ])->onlyInput("email");
    }

    public function reset_password_confirm_show(Request $request)
    {
        $token_exist = DB::table('password_reset_tokens')->where('token', $request->token)->first();
        if ($token_exist) {
            $token = $token_exist->token;
            $email = $token_exist->email;
            return view('web.login.reset-password', compact(['token', 'email']));
        } else {
            alert()->error("Error", "Invalid url.")->showConfirmButton("OK");
        }
        return view('web.login.reset-password');
    }

    public function reset_password_confirm(PasswordResetRequest $request, string $token)
    {
        $token_query = DB::table('password_reset_tokens')->where('token', $token);
        $token_exist = $token_query->first();
        if ($token_exist) {
            $token = $token_exist->token;
            $email = $token_exist->email;
            $user = User::query()->where("email", $email)->first();
            if (!empty($user)) {
                if ($user->deleted_at) {
                    return view('web.login.reset-password', compact(['token', 'email']))->withErrors([
                        "deleted_at" => "Your account has been blocked."
                    ]);
                }
                if ($user->status != 1) {
                    return view('web.login.reset-password', compact(['token', 'email']))->withErrors([
                        "status" => "Your account has not been approved."
                    ]);
                }
                $password = $request->password;
                if (Hash::check($password, $user->password)) {
                    return view('web.login.reset-password', compact(['token', 'email']))->withErrors([
                        "password" => "Your new password cannot be the same as your old password."
                    ]);
                }
                try {
                    $user->update(['password' => Hash::make($password)]);
                    $token_query->delete();
                    $token = null;
                    alert()->success("Success",
                        "Your password has been changed successfully.")->showConfirmButton("OK");
                    return redirect()->route('login.index');
                } catch (\Exception $e) {
                    alert()->error("Error", "An error occurred while changing the password.")->showConfirmButton("OK");
                }
            } else {
                alert()->error("Error", "User not found.")->showConfirmButton("OK");
            }
            return view('web.login.reset-password', compact(['token', 'email']));
        } else {
            alert()->error("Error", "Invalid url.")->showConfirmButton("OK");
        }
        return view('web.login.reset-password');
    }
}
