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
Route::prefix('login')->name('login.')->controller('LoginController')
    ->middleware('guest:web')
    ->group(function () {
        Route::get('', "index")->name('index');
        Route::post('', "login");
    });
Route::post('logout', [\App\Http\Controllers\Web\LoginController::class, "logout"])->name('logout');
Route::prefix('register')->name('register.')->controller('RegisterController')
    ->middleware('guest:web')
    ->group(function () {
        Route::get('', "index")->name('index');
        Route::post('', "store");
    });
Route::get('auth/verify/{token}',
    [\App\Http\Controllers\Web\AuthController::class, "verify"])->name('auth.verify.token');
Route::get('auth/social/{social}/redirect',
    [\App\Http\Controllers\Web\AuthController::class, "social_redirect"])->name('auth.social.redirect')
    ->whereIn("social", ['google', 'facebook', 'twitter', 'github']);
Route::get('auth/social/{social}/callback',
    [\App\Http\Controllers\Web\AuthController::class, "social_callback"])->name('auth.social.callback')
    ->whereIn("social", ['google', 'facebook', 'twitter', 'github']);
Route::get('reset-password',
    [\App\Http\Controllers\Web\LoginController::class, 'reset_password_show'])->name('reset.password');
Route::post('reset-password', [\App\Http\Controllers\Web\LoginController::class, 'reset_password']);
Route::get('reset-password/{token}',
    [\App\Http\Controllers\Web\LoginController::class, 'reset_password_confirm_show'])->name('reset.password.confirm');
Route::post('reset-password/{token}', [\App\Http\Controllers\Web\LoginController::class, 'reset_password_confirm']);
Route::prefix('user')->name('user.')->controller('UserController')->middleware('auth:web')->group(function () {
    Route::get('profile', "profile")->name('profile');
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
