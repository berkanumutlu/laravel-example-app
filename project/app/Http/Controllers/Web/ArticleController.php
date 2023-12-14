<?php

namespace App\Http\Controllers\Web;

use App\Models\Articles;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['categories'] = Category::query()->where('status', 1)
            ->orderBy('order', 'asc')->orderBy('created_at', 'desc')->get();
    }

    public function index()
    {
        $this->data['records'] = Articles::query()->where('status', 1)
            ->with(['category:id,name,slug', 'user:id,name,username'])
            ->select(['id', 'title', 'slug', 'image', 'publish_date', 'read_time', 'category_id', 'user_id'])
            ->orderBy('publish_date', 'desc')
            ->paginate(15);
        $this->data['title'] = 'Article List';
        return view('web.article.index', $this->data);
    }

    public function show(string $slug)
    {
        $this->data['record'] = Articles::query()->where('slug', $slug)
            ->with(['category:id,name,slug', 'user:id,name,username,title,description,image'])
            ->select([
                'id', 'title', 'slug', 'body', 'image', 'tags', 'read_time', 'view_count', 'like_count', 'publish_date',
                'category_id', 'user_id'
            ])
            ->first();
        return view('web.article.detail', $this->data);
    }

    //public function category(string $slug)
    /*public function category(Request $request, string $slug) {
        dd($request->slug);
    }*/
    public function category(Request $request, string $slug)
    {
        $category = Category::query()->with('articlesActive')
            ->select(['id', 'name'])
            ->where('slug', $slug)->first();
        $records = $category->articlesActive()
            ->select(['id', 'title', 'slug', 'image', 'publish_date', 'read_time', 'category_id', 'user_id'])
            ->orderBy('publish_date', 'desc')
            ->paginate(15);
        $records->load(['category:id,name,slug', 'user:id,name,username']);
        /*$records = $category->articlesActive()->with(['category:id,name,slug', 'user:id,name,username'])
            ->select(['id', 'title', 'image', 'publish_date', 'read_time', 'category_id', 'user_id'])
            ->paginate(15);*/
        /*$records = Articles::query()->with(['category:id,name,slug', 'user:id,name,username'])
            ->select(['id', 'title', 'image', 'publish_date', 'read_time', 'category_id', 'user_id'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->paginate(15);*/
        $this->data['records'] = $records;
        $this->data['title'] = $category->name.'  Article List';
        return view('web.article.index', $this->data);
    }
}
