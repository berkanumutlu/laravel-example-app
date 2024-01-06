<?php

namespace App\Http\Controllers\Web;

//use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        //Debugbar::startMeasure('render', 'Time for HomeController rendering');
        //Debugbar::stopMeasure('render');
        return view('web.home.index');
    }
}
