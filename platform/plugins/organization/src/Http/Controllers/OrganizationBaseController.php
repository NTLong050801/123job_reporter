<?php
namespace Workable\Organization\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;

class organizationBaseController extends AdminBaseController
{
    protected $viewPath = 'plugins.organization::pages';
    protected $routeList = '';

    public function index(Request $request)
    {
        return 'Welcome to controller: '. __("plugins.organization::app.name");
    }
}
