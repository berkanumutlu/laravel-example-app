<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
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
        parent::__construct();
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        $this->favicon = asset('assets/auth/images/neptune.png');
        $this->title = 'Login';
    }

    public function index()
    {
        return view('admin.login.index', ['favicon' => $this->favicon, 'title' => $this->title]);
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
        /*$admin = Admin::where("email", $email)->first();
        if (!empty($admin) && Hash::check($password, $admin->password)) {
            Auth::guard('admin')->login($admin, $remember_me);
            //Auth::guard('admin')->loginUsingId($admin->id, $remember_me);
            return redirect()->route('admin.dashboard');
        }*/
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], $remember_me)) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login.index')->withErrors([
            "email" => "Email or password is incorrect."
        ])->onlyInput("email", "remember_me");
    }

    public function logout(Request $request)
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
