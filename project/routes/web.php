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
Route::prefix('login')->name('login.')->controller('LoginController')->middleware('guest:web')->group(function () {
    Route::get('', "index")->name('index');
    Route::post('', "login");
});
Route::post('logout', [\App\Http\Controllers\Web\LoginController::class, "logout"])->name('logout');
Route::prefix('register')->name('register.')->controller('RegisterController')->middleware('guest:web')->group(function () {
    Route::get('', "index")->name('index');
    Route::post('', "store");
});
Route::prefix('auth')->name('auth.')->controller('AuthController')->group(function () {
    Route::get('verify/{token}', "verify")->name('verify.token');
    Route::get('social/{social}/redirect', "social_redirect")->name('social.redirect')->whereIn("social", ['google', 'facebook', 'twitter', 'github']);
    Route::get('social/{social}/callback', "social_callback")->name('social.callback')->whereIn("social", ['google', 'facebook', 'twitter', 'github']);
});
Route::prefix('reset-password')->name('reset.password.')->controller('LoginController')->group(function () {
    Route::get('', "reset_password_show")->name('index');
    Route::post('', "reset_password");
    Route::get('{token}', "reset_password_confirm_show")->name('confirm');
    Route::post('{token}', "reset_password_confirm");
});
Route::prefix('user')->name('user.')->controller('UserController')->middleware('auth:web')->group(function () {
    Route::get('profile', "edit")->name('profile');
    Route::post('profile/edit/{user:id}', "update")->name('profile.edit')->whereNumber('id');
    Route::get('change-password', "show_change_password")->name('change.password');
    Route::post('change-password/{user:id}', "update_password")->name('change.password.edit')->whereNumber('id');
    Route::post('socials/edit/{user:id}', "update_socials")->name('social.edit')->whereNumber('id');
    Route::prefix('article')->name('article.')->group(function () {
        Route::get('list', "show_article_list")->name('list');
        Route::get('detail/{article:slug}', "edit_article")->name('detail');
        Route::post('edit/{article:id}', "update_article")->name('edit')->whereNumber('id');
        Route::get('add', "create_article")->name('add');
        Route::post('add', "store_article");
    });
});
Route::prefix('article')->name('article.')->controller('ArticleController')->group(function () {
    Route::get('list', "index")->name('index');
    Route::get('category/{slug}', "category")->name('category');
    Route::get('author/{user:username}', "author")->name('author');
    Route::get('detail/{slug}', "show")->name('detail')->middleware('visitedArticle');
    Route::post('detail/{article:slug}/post-comment', "post_comment")->name('comment.post');
    Route::post('like', "like")->name('like');
    Route::post('comment/like', "comment_like")->name('comment.like');
    Route::post('comment/dislike', "comment_like")->name('comment.dislike');
    Route::get('search', "search")->name('search');
});
