<?php

namespace App\Http\Controllers\Web;

//use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Support\Facades\Cache;

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
        /*$feature_category_list = Cache::get('feature_category_list');
        if (!Cache::has('feature_category_list')) {
            $most_popular_categories = Article::query()
                ->select(['id', 'category_id'])
                ->with(['category:id,name,slug,image,description,created_at', 'category.articlesActive'])
                ->whereHas('category', function ($query) {
                    $query->where('status', 1);
                })
                ->orderBy('view_count', 'desc')
                ->groupBy('category_id')
                ->limit(4)
                ->get();
            $feature_category_list = [];
            $most_popular_categories->map(function ($item) use (&$feature_category_list) {
                if ($item->category->relationLoaded('articlesActive')) {
                    $item->category->load('articlesActive');
                }
                $feature_category_list[] = $item->category;
            });
            Cache::put('feature_category_list', $feature_category_list);
        }*/
        $feature_category_list = Cache::remember('feature_category_list', null, function () {
            $most_popular_categories = Article::query()->status(1)->approveStatus(1)
                ->select(['id', 'category_id'])
                ->with(['category:id,name,slug,image,description,created_at', 'category.articlesActive'])
                ->whereHas('category', function ($query) {
                    $query->where('status', 1);
                })
                ->orderBy('view_count', 'desc')
                ->groupBy('category_id')
                ->limit(4)
                ->get();
            $category_list = [];
            $most_popular_categories->map(function ($item) use (&$category_list) {
                if (!$item->category->relationLoaded('articlesActive')) {
                    $item->category->load('articlesActive');
                }
                $category_list[] = $item->category;
            });
            return $category_list;
        });
        /*$most_popular_categories->map(function ($item) {
            if ($item->relationLoaded('category')) {
                $item->load('category');
            }
        });
        if ($most_popular_categories->category->isNotEmpty()) {

        }*/
        $popular_article_list = Cache::remember('popular_article_list', null, function () {
            return Article::query()->status(1)->approveStatus(1)
                ->with(['category:id,name,slug', 'user:id,name,username'])
                ->select([
                    'id', 'title', 'slug', 'image', 'publish_date', 'read_time', 'category_id', 'user_id', 'status',
                    'updated_at'
                ])
                ->orderBy('view_count', 'desc')
                ->limit(10)->get();
        });
        $last_article_list = Cache::remember('last_article_list', null, function () {
            return Article::query()->status(1)->approveStatus(1)
                ->with(['category:id,name,slug', 'user:id,name,username'])
                ->select([
                    'id', 'title', 'slug', 'image', 'publish_date', 'read_time', 'category_id', 'user_id', 'status',
                    'updated_at'
                ])
                ->orderBy('publish_date', 'desc')
                ->limit(12)->get();
        });
        return view('web.home.index', compact(['feature_category_list', 'popular_article_list', 'last_article_list']));
    }
}
