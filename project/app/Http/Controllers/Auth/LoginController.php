<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

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
}
