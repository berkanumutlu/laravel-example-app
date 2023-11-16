<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @var array
     */
    protected array $data = [];

    public function __construct()
    {
        $this->data['favicon'] = asset('assets/admin/images/neptune.png');
        $this->data['title'] = '';
        $this->data['search_form'] = false;
        $this->data['avatar'] = asset('assets/admin/images/avatars/avatar.png');
    }

    public function check_slug($model, string $slug)
    {
        return $model::where('slug', $slug)->first();
    }
}
