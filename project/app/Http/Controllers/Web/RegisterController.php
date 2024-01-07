<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        $title = 'Register';
        return view('web.register.index', compact(['title']));
    }
}
