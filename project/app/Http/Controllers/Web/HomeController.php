<?php

namespace App\Http\Controllers\Web;

//use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        //Log::debug('test debug message');
        //Log::emergency('test emergency message');
        //Log::alert('test alert message');
        //Log::critical('test critical message');
        //Log::error('test error message');
        //Log::warning('test warning message');
        //Log::notice('test notice message');
        //Log::info('test info message');
        //Debugbar::startMeasure('render', 'Time for HomeController rendering');
        //Debugbar::stopMeasure('render');
        $feature_category_list = Category::query()
            ->with(['articlesActive:id'])
            ->select(['id', 'name', 'slug', 'image'])
            ->where('status', 1)
            ->where('feature_status', 1)
            ->orderBy('order', 'asc')
            ->limit(4)->get();
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
        return view('web.home.index', compact(['feature_category_list', 'popular_article_list', 'last_article_list']));
    }
}
