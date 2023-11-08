<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group. Make something great!
|
*/
Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, "index"])->name('dashboard');
//Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, "index"])->middleware('language')->name('dashboard');
Route::prefix("login")->name("login.")->controller('\App\Http\Controllers\Auth\LoginController')
    ->group(function () {
        Route::get('', "index")->name('index');
    });
Route::prefix("article")->name("article.")->controller('ArticleController')
    ->group(function () {
        Route::get('', "index")->name('index');
        Route::get('add', "create")->name('add');
    });
Route::prefix("category")->name("category.")->controller('CategoryController')
    ->group(function () {
        Route::get('', "index")->name('index');
        Route::get('add', "create")->name('add');
        Route::post('add', "store");
        Route::get('edit/{id}', "edit")->name('edit')->whereNumber('id');
        Route::post('edit/{id}', "update")->whereNumber('id');
        Route::post('change-status', "change_status")->name('change_status');
        Route::post('delete', "destroy")->name('delete');
    });
