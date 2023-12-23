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
Route::prefix("login")->name("login.")->controller('LoginController')
    ->middleware('guest:admin')
    ->withoutMiddleware(['auth:admin'])
    ->group(function () {
        Route::get('', "index")->name('index');
        Route::post('', "login");
    });
Route::post('logout', [\App\Http\Controllers\Admin\LoginController::class, "logout"])->name('logout');
Route::prefix("article")->name("article.")->controller('ArticleController')
    ->group(function () {
        Route::get('', "index")->name('index');
        Route::get('add', "create")->name('add');
        Route::post('add', "store");
        Route::get('edit/{id}', "edit")->name('edit')->whereNumber('id');
        Route::post('edit/{id}', "update")->whereNumber('id');
        Route::post('change-status', "change_status")->name('change_status');
        Route::post('delete', "destroy")->name('delete');
    });
Route::prefix("article/comments")->name("article.comments.")->controller('ArticleCommentController')
    ->group(function () {
        Route::get('pending', "pending_comments")->name('pending');
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
Route::prefix("laravel-filemanager")->group(function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::prefix("settings")->name("settings.")->controller('SettingsController')
    ->group(function () {
        Route::get('', "index")->name('index');
        Route::post('', "update");
    });
Route::prefix("user")->name("user.")->controller('UserController')
    ->group(function () {
        Route::get('list', "index")->name('index');
        Route::get('add', "create")->name('add');
        Route::post('add', "store");
        Route::get('edit/{user:id}', "edit")->name('edit')->whereNumber('id');
        Route::post('edit/{id}', "update")->whereNumber('id');
        Route::post('delete', "destroy")->name('delete');
        Route::post('change-status', "change_status")->name('change_status');
    });
