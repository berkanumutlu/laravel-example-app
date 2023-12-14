<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [\App\Http\Controllers\Web\HomeController::class, "index"])->name('home');
Route::get('/search', [\App\Http\Controllers\Web\BaseController::class, "search"])->name('search');
Route::prefix('article')->name('article.')->controller('ArticleController')->group(function () {
    Route::get('/list', "index")->name('index');
    Route::get('/detail/{slug:articles}', "show")->name('detail');
    Route::get('/category/{slug:categories}', "category")->name('category');
});
