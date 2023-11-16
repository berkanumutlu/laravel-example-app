<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * php artisan vendor:publish --tag=laravel-pagination
         */
        //Paginator::useBootstrapFive();
        Paginator::defaultView("vendor.pagination.custom");
        Carbon::setLocale(config('app.locale'));
    }
}
