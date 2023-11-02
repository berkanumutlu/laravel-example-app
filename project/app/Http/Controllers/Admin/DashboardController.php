<?php

namespace App\Http\Controllers\Admin;

class DashboardController extends BaseController
{
    public function index()
    {
        $this->data['title'] = 'Dashboard';
        return view('admin.dashboard.index', $this->data);
    }
}
