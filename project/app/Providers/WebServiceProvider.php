<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Settings;
use App\Models\SocialMedia;
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
        //if (!strpos(request()->url(), 'admin')) {
        if (!request()->fullUrlIs('*admin*')) {
            $settings = $this->get_settings();
            View::composer([
                'web.layouts.*', 'layouts.email', 'web.email.*', 'components.web.*', 'web.home.index',
                'web.article.detail'
            ], function ($view) use ($settings) {
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
            View::composer('web.layouts.index', function ($view) {
                $view->with(['socials' => $this->get_socials()]);
            });
        }
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
            return Category::query()->where('status', 1)->where('parent_id', null)->with(['childActiveCategory'])
                ->orderBy('order', 'asc')->orderBy('created_at', 'desc')->get();
        });
    }

    public function get_socials()
    {
        return Cache::remember('socials', null, function () {
            return SocialMedia::query()->select(['id', 'name', 'icon', 'link'])->where('status', 1)
                ->orderBy('sort', 'asc')->orderBy('created_at', 'asc')->get();
        });
    }
}
