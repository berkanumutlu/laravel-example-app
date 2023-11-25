<?php

namespace App\Http\Controllers\Web;

class ArticleController extends BaseController
{
    public function index()
    {
        $this->data['title'] = 'Article List';
        return view('web.article.index', $this->data);
    }
}
