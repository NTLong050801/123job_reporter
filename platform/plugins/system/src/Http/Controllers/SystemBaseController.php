<?php
namespace Workable\System\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;

class SystemBaseController extends AdminBaseController
{
    protected $viewPath = 'plugins.system::pages';
    protected $routeList = '';

    public function index(Request $request)
    {
        return 'Welcome to controller: '. __("plugins.system::app.name");
    }
}
