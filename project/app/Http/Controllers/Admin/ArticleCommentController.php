<?php

namespace App\Http\Controllers\Admin;

use App\Models\ArticleComments;

class ArticleCommentController extends BaseController
{
    public function pending_comments()
    {
        $this->data['records'] = ArticleComments::query()
            ->with(['article:id,title,slug', 'user:id,name', 'parent:id,comment'])
            ->Pending()->orderBy('article_id', 'asc')
            ->paginate(20);
        $this->data['columns'] = [
            'Id', 'Article', 'User', 'Parent Comment', 'Comment', 'IP Address', 'User Agent', 'Creation Time', 'Actions'
        ];
        $this->data['title'] = 'Pending Article Comment List';
        return view('admin.article.comments.index', $this->data);
    }
}
