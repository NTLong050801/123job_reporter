<?php
namespace Workable\Menu\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;

class MenuBaseController extends AdminBaseController
{
    protected $viewPath = 'plugins.menu::pages';
    protected $routeList = '';

    public function index(Request $request)
    {
        return 'Welcome to controller: '. __("plugins.menu::app.name");
    }
}
