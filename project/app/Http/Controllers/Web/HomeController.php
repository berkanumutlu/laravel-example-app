<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;

class HomeController extends BaseController
{
    public function index()
    {
        $this->data['categories'] = Category::query()->where('status', 1)->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')->get();
        return view('web.home.index', $this->data);
    }
}
