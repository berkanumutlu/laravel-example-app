<?php

namespace App\Http\Controllers\Admin;

use App\Models\SocialMedia;

class SocialMediaController extends BaseController
{
    public function index()
    {
        $this->data['records'] = SocialMedia::query()->orderBy('created_at', 'asc')->get();
        $this->data['title'] = 'Social Media';
        return view('admin.social-media.index', $this->data);
    }
}
