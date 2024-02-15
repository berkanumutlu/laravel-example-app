<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Settings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class WebServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['web.layouts.*', 'web.home.index', 'layouts.email', 'web.email.*', 'components.web.*'],
            function ($view) {
                $settings = $this->get_settings();
                $favicon = asset('assets/web/images/logomark.min.svg');
                $site_name = $settings->site_name ?? '';
                $site_slogan = $settings->site_slogan ?? '';
                $site_logo = !empty($settings->image_logo) ? asset($settings->image_logo) : asset('assets/web/images/logomark.min.svg');
                $view->with(compact(['site_name', 'site_slogan', 'site_logo', 'favicon', 'settings']));
            });
        View::composer('components.web.sidebar', function ($view) {
            $categories = $this->get_categories();
            $view->with(compact(['categories']));
        });
    }

    public function get_settings()
    {
        return Cache::remember('settings', null, function () {
            $settings_formatted = new \stdClass();
            $settings = Settings::query()->where('status', 1)->select(['key_name', 'key_value'])->get();
            foreach ($settings as $item) {
                $key_name = $item->key_name;
                $settings_formatted->$key_name = $item->key_value;
            }
            return $settings_formatted;
        });
    }

    public function get_categories()
    {
        return Cache::remember('categories', null, function () {
            return Category::query()->where('status', 1)
                ->orderBy('order', 'asc')->orderBy('created_at', 'desc')->get();
        });
    }
}
