<?php

namespace App\Http\Controllers\Web;

class HomeController extends BaseController
{
    public function index()
    {
        return view('web.home.index');
    }
}
