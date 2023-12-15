<?php

namespace App\Http\Controllers\Web;

use App\Models\Settings;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

//use Barryvdh\Debugbar\Facades\Debugbar;

class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @var array
     */
    protected array $data = [];

    public function __construct()
    {
        //Debugbar::startMeasure('render', 'Time for BaseController rendering');
        $this->data['settings'] = $this->get_settings();
        $this->data['favicon'] = asset('assets/web/images/logomark.min.svg');
        $this->data['site_name'] = config('app.name');
        $this->data['site_image'] = asset('assets/web/images/logomark.min.svg');
        $this->data['avatar'] = asset('assets/web/images/avatars/avatar.png');
        //Debugbar::stopMeasure('render');
    }

    public function search()
    {
        return view("web.home.index", $this->data);
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
