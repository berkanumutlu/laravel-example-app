<?php

namespace App\Http\Controllers\Web;

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
        $this->data['favicon'] = asset('assets/web/images/logomark.min.svg');
        $this->data['site_name'] = config('app.name');
    }

    public function search()
    {
        return view("web.home.index", $this->data);
    }
}
