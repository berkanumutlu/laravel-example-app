<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$records = Category::all();
        //$records = Category::all()->toArray();
        //$records = Category::with('parentCategory')->get();
        //$records = Category::with('parentCategory:id,name,slug')->get();
        //$records = Category::with('parentCategory:id,name,slug')->select(['id', 'name', 'slug', 'description', 'order', 'parent_id', 'created_at'])->get()->makeVisible(['created_at']);
        //$records = Category::with(['parentCategory:id,name,slug', 'user:name'])->select(['id', 'name', 'slug', 'description', 'status', 'feature_status', 'order', 'parent_id', 'created_at'])->get();
        $records = Category::with(['parentCategory:id,name,slug'])->select([
            'id', 'name', 'slug', 'description', 'status', 'feature_status', 'order', 'parent_id', 'created_at'
        ])->orderBy('id', 'desc')->get();
        /*foreach ($records as $record) {
            $record->name = 'Berkan';
            if ($record->parentCategory) {
                dd($record);
            }
        }*/
        $this->data['records'] = $records;
        $this->data['columns'] = [
            'Id', 'Name', 'Slug', 'Description', 'Status', 'Feature Status', 'Order', 'Parent Category',
            'Creation Time', 'Actions'
        ];
        $this->data['title'] = 'Category List';
        return view('admin.category.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->data['title'] = 'Add Category';
        return view('admin.category.add', $this->data);
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
