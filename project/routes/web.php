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
Route::prefix('article')->name('article.')->controller('ArticleController')->group(function () {
    Route::get('list', "index")->name('index');
    Route::get('category/{slug}', "category")->name('category');
    Route::get('detail/{slug}', "show")->name('detail');
    Route::post('detail/{article:slug}/post-comment', "post_comment")->name('comment.post');
    Route::post('like', "like")->name('like');
    Route::post('comment/like', "comment_like")->name('comment.like');
    Route::post('comment/dislike', "comment_like")->name('comment.dislike');
});
