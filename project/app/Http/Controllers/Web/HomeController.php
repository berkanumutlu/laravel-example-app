<?php

namespace App\Http\Controllers\Web;

//use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Controllers\Controller;
use App\Models\Article;

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
        /*$feature_category_list = Category::query()
            ->with(['articlesActive:id'])
            ->select(['id', 'name', 'slug', 'image'])
            ->where('status', 1)
            ->where('feature_status', 1)
            ->orderBy('order', 'asc')
            ->limit(4)
            ->get();*/
        $most_popular_categories = Article::query()
            ->select(['id', 'category_id'])
            ->with('category:id,name,slug,image,description,created_at')
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->orderBy('view_count', 'desc')
            ->groupBy('category_id')
            ->get();
        $feature_category_list = [];
        $most_popular_categories->map(function ($item) use (&$feature_category_list) {
            if (count($feature_category_list) < 4) {
                $feature_category_list[] = $item->category;
            }
        });
        /*$most_popular_categories->map(function ($item) {
            if ($item->relationLoaded('category')) {
                $item->load('category');
            }
        });
        if ($most_popular_categories->category->isNotEmpty()) {

        }*/
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
