<?php

namespace App\Http\Controllers\Web;

//use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Controllers\Controller;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        //Debugbar::startMeasure('render', 'Time for HomeController rendering');
        //Debugbar::stopMeasure('render');
        $popular_article_list = Article::query()->status(1)
            ->with(['category:id,name,slug', 'user:id,name,username'])
            ->select(['id', 'title', 'slug', 'image', 'publish_date', 'read_time', 'category_id', 'user_id'])
            ->orderBy('view_count', 'desc')
            ->limit(6)->get();
        $last_article_list = Article::query()->status(1)
            ->with(['category:id,name,slug', 'user:id,name,username'])
            ->select(['id', 'title', 'slug', 'image', 'publish_date', 'read_time', 'category_id', 'user_id'])
            ->orderBy('publish_date', 'desc')
            ->limit(9)->get();
        return view('web.home.index', compact(['popular_article_list', 'last_article_list']));
    }
}
