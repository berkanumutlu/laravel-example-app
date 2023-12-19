<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->data['records'] = User::query()->select([
            'id', 'name', 'email', 'username', 'image', 'title', 'description', 'status', 'created_at'
        ])->orderBy('id', 'desc')->get();
        $this->data['columns'] = [
            'Id', 'Image', 'Name', 'Email', 'Username', 'Title', 'Description', 'Status', 'Creation Time', 'Actions'
        ];
        $this->data['title'] = 'User List';
        return view('admin.user.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
