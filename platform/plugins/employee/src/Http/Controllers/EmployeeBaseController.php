<?php
namespace Workable\Employee\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;

class EmployeeBaseController extends AdminBaseController
{
    protected $viewPath = 'plugins.employee::pages';
    protected $routeList = '';

    public function index(Request $request)
    {
        return 'Welcome to controller: '. __("plugins.employee::app.name");
    }
}
