<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
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
        //$user = User::where("email", $email)->where("status", 1)->first();
        /*if (Auth::attempt(['email' => $email, 'password' => $password], $remember_me)) {
            return redirect()->route('admin.dashboard');
        }*/
        /*if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1], $remember_me)) {
            return redirect()->route("admin.index");
        }*/
        if (!empty($user) && Hash::check($password, $user->password)) {
            Auth::login($user, $remember_me);
            //Auth::loginUsingId($user->id, $remember_me);
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login.index')->withErrors([
            "email" => "Email or password is incorrect."
        ])->onlyInput("email", "remember_me");
    }

    public function logout(Request $request)
    {
        $result = ['status' => false, 'message' => null];
        if (Auth::check()) {
            try {
                Auth::logout();
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
