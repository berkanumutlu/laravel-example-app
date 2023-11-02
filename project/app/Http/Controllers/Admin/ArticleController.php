<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
