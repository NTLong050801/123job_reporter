<?php
namespace Workable\GoogleLog\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;

class GoogleLogBaseController extends AdminBaseController
{
    protected $viewPath = 'plugins.google-log::pages';
    protected $routeList = '';

    public function index(Request $request)
    {
        return 'Welcome to controller: '. __("plugins.google-log::app.name");
    }
}
