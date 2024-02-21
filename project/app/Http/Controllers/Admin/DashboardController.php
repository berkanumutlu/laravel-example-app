<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;

class DashboardController extends BaseController
{
    public function index()
    {
        $most_popular_articles = Article::query()->select(['title', 'view_count'])->status(1)
            ->orderBy('view_count', 'desc')->limit(7)->get()
            ->map(function ($item) {
                $item->title = Str::limit($item->title, 15);
                return $item;
            });
        if (!empty($most_popular_articles)) {
            $this->data['most_popular_articles_labels'] = $most_popular_articles->pluck('title')->__toString();
            $this->data['most_popular_articles_values'] = $most_popular_articles->pluck('view_count')->__toString();
        }
        $categories = Category::query()->where('status', 1)->select(['id', 'name'])
            ->withCount('articlesActive')
            ->orderByDesc('articles_active_count')
            ->limit(7)->get();
        if (!empty($categories)) {
            $this->data['category_articles_labels'] = $categories->pluck('name')->__toString();
            $this->data['category_articles_values'] = $categories->pluck('articles_active_count')->__toString();
        }
        $this->data['title'] = 'Dashboard';
        return view('admin.dashboard.index', $this->data);
    }
}
