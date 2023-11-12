<?php

namespace App\Http\Controllers\Admin;

use App\Models\Articles;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Articles::with(['category:id,name', 'user:id,name'])->select([
            'id', 'title', 'slug', 'body', 'image', 'status', 'read_time', 'view_count', 'like_count',
            'publish_date', 'category_id', 'user_id', 'created_at'
        ])->orderBy('id', 'desc')->paginate(20);
        $this->data['records'] = $records;
        $this->data['columns'] = [
            'Id', 'Title', 'Slug', 'Body', 'Image', 'Status', 'Read Time', 'Views', 'Likes', 'Publish Date',
            'Category', 'User', 'Creation Time', 'Actions'
        ];
        $this->data['title'] = 'Article List';
        return view('admin.article.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->data['title'] = 'Add Article';
        return view('admin.article.add', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
