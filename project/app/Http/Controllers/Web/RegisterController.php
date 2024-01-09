<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserStoreRequest;
use App\Models\User;
use App\Models\UserVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            $token = Str::random(60);
            $data = [
                'user_id' => $user->id,
                'token'   => $token
            ];
            UserVerification::create($data);
            /*
             * Onay maili gönderme işlemi
             */
            $title = 'Verify Your Account';
            Mail::send('web.email.verify', compact(['token', 'user', 'title']), function ($mail) use ($user, $title) {
                $mail->to($user->email);
                $settings = cache('settings');
                if (!empty($settings) && !empty($settings->site_name)) {
                    $mail->subject($title.' - '.$settings->site_name);
                } else {
                    $mail->subject($title);
                }
            });
        } catch (\Exception $e) {
            alert()->error("Error", "An error occurred while registering.")->showConfirmButton("OK");
            return redirect()->back()->exceptInput("_token", "password", "password_confirmation");
        }
        alert()->success("Success",
            "You have successfully registered. A verification email has been sent to your email address.")
            ->showConfirmButton("OK");
        return redirect()->route('register.index');
    }

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
}
