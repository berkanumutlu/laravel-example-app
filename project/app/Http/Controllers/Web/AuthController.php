<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function verify(Request $request)
    {
        $user_verification = UserVerification::query()->where('token', $request->token)->first();
        if (empty($user_verification)) {
            abort(404);
        }
        $user = $user_verification->user;
        if (is_null($user->email_verified_at)) {
            $user->email_verified_at = now();
            $user->status = 1;
            $user->save();
            $user_verification->delete();
            alert()->success("Success",
                "Your account has been verified. You can log in to your account by going to the login page.")
                ->showConfirmButton("OK");
        } else {
            alert()->info("Info", "This account has been previously verified.")->showConfirmButton("OK");
        }
        return redirect()->route('login.index');
    }

    public function social_redirect($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function social_callback($driver, Request $request)
    {
        try {
            $social_user = Socialite::driver($driver)->user();
            $user = User::query()->where('email', $social_user->getEmail())->first();
            if (!empty($user)) {
                if ($user->deleted_at) {
                    return redirect()->route('register.index')->withErrors([
                        "deleted_at" => "Your account has been blocked."
                    ]);
                }
                if ($user->status != 1) {
                    return redirect()->route('register.index')->withErrors([
                        "status" => "Your account has not been approved."
                    ]);
                }
                Auth::guard('web')->login($user);
                return redirect()->route('home');
            }
            $data = [
                'name'              => $social_user->getName(),
                'email'             => $social_user->getEmail(),
                'password'          => bcrypt(Str::random(16)),
                'status'            => 1,
                'email_verified_at' => now(),
                'oauth_type'        => $driver,
                'oauth_id'          => $social_user->getId()
            ];
            /*
             * For Google full name without username
             */
            if (!empty($social_user->user['given_name'])) {
                $data['name'] = $social_user->user['given_name'].' '.$social_user->user['family_name'];
            }
            if ($social_user->getAvatar()) {
                $data['image'] = $social_user->getAvatar();
            }
            /*
             * For Twitter original size avatar
             */
            if (!empty($social_user->attributes['avatar_original'])) {
                $data['image'] = $social_user->attributes['avatar_original'];
            }
            /*
             * For Github user description
             */
            if (!empty($social_user->user['bio'])) {
                $data['description'] = $social_user->user['bio'];
            }
            $data['username'] = Str::slug($data['name']);
            if ($social_user->getNickname()) {
                $data['username'] = $social_user->getNickname();
            }
            if (!empty($data['username'])) {
                $username_exists = User::query()->where('username', $data['username'])->exists();
                if ($username_exists) {
                    $data['username'] = Str::slug($data['username'].uniqid());
                }
            }
            $user_create = User::create($data);
            alert()->success("Success",
                "You have successfully registered. You can login with your ".$driver." account.")
                ->showConfirmButton("OK");
            return redirect()->route('login.index');
            //Auth::guard('web')->login($user_create);
            //return redirect()->route('user.profile.index');
        } catch (\Exception $e) {
            //abort(404, $e->getMessage());
            $error_message = "Invalid url.";
            /*
             * For Github
             */
            if (!empty($request->error)) {
                $error_message = $request->error;
            }
            /*
             * For Twitter
             */
            if (!empty($request->denied)) {
                $error_message = "access_denied";
            }
            alert()->error("Error", $error_message)->showConfirmButton("OK");
            return redirect()->route('register.index');
        }
    }
}
