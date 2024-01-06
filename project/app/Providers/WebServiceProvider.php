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
        View::composer('web.layouts.*', function ($view) {
            $settings = $this->get_settings();
            $favicon = asset('assets/web/images/logomark.min.svg');
            $site_name = config('app.name');
            $site_image = !empty($settings->image_logo) ? asset($settings->image_logo) : asset('assets/web/images/logomark.min.svg');
            $view->with(compact(['site_name', 'site_image', 'favicon', 'settings']));
        });
        View::composer('web.layouts.sidebar', function ($view) {
            $categories = Category::query()->where('status', 1)
                ->orderBy('order', 'asc')->orderBy('created_at', 'desc')->get();
            $view->with(compact('categories'));
        });
    }

    public function get_settings()
    {
        if (Cache::has('settings')) {
            return Cache::get('settings');
        }
        $formatted_settings = new \stdClass();
        $settings = Settings::query()->where('status', 1)->select(['key_name', 'key_value'])->get();
        foreach ($settings as $item) {
            $key_name = $item->key_name;
            $formatted_settings->$key_name = $item->key_value;
        }
        Cache::set('settings', $formatted_settings);
        return $formatted_settings;
    }
}
