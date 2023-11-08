<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * @var string|null
     */
    private $favicon;
    /**
     * @var string|null
     */
    private $title;

    public function __construct()
    {
        $this->favicon = asset('assets/auth/images/neptune.png');
        $this->title = 'Login';
    }

    public function index()
    {
        return view('auth.login', ['favicon' => $this->favicon, 'title' => $this->title]);
    }

    public function login(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember_me = isset($request->remember_me);
        $user = User::where("email", $email)->first();
        if (!empty($user) && Hash::check($password, $user->password)) {
            Auth::login($user);
            //Auth::loginUsingId($user->id);
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login.index')->withErrors([
            "email" => "Email or password is incorrect."
        ])->onlyInput("email", "remember_me");
    }
}
