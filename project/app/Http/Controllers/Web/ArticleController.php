<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    public function index()
    {
        $this->data['title'] = 'Article List';
        return view('web.article.index', $this->data);
    }

    public function show(string $slug)
    {
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
        $records = $category->articlesActive()->paginate(16);
        $records->load(['category:id,name,slug', 'user:id,name']);
        /*$records = $category->articlesActive()->with(['category:id,name,slug', 'user:id,name'])
            ->select(['id', 'title', 'image', 'publish_date', 'read_time', 'category_id', 'user_id'])
            ->paginate(16);*/
        /*$records = Articles::query()->with(['category:id,name,slug', 'user:id,name'])
            ->select(['id', 'title', 'image', 'publish_date', 'read_time', 'category_id', 'user_id'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->paginate(16);*/
        $this->data['records'] = $records;
        $this->data['title'] = $category->name.'  Article List';
        return view('web.article.index', $this->data);
    }
}
