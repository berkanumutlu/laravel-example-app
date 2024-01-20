<?php

namespace App\Http\Controllers\Web;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserStoreRequest;
use App\Models\User;
use App\Models\UserVerification;
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
            //event(new UserRegistered($user));
            /*$token = Str::random(60);
            $data = [
                'user_id' => $user->id,
                'token'   => $token
            ];
            UserVerification::create($data);*/
            /*
             * Onay maili gönderme işlemi
             */
            /*$title = 'Verify Your Account';
            Mail::send('web.email.verify', compact(['token', 'user', 'title']), function ($mail) use ($user, $title) {
                $mail->to($user->email);
                $settings = cache('settings');
                if (!empty($settings) && !empty($settings->site_name)) {
                    $mail->subject($title.' - '.$settings->site_name);
                } else {
                    $mail->subject($title);
                }
            });*/
        } catch (\Exception $e) {
            alert()->error("Error", "An error occurred while registering.")->showConfirmButton("OK");
            return redirect()->back()->exceptInput("_token", "password", "password_confirmation");
        }
        alert()->success("Success",
            "You have successfully registered. A verification email has been sent to your email address.")
            ->showConfirmButton("OK");
        return redirect()->route('register.index');
    }
}
