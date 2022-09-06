<?php
namespace Workable\RobotLog\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;

class RobotLogBaseController extends AdminBaseController
{
    protected $viewPath = 'plugins.robot-log::pages';
    protected $routeList = '';

    public function index(Request $request)
    {
        return 'Welcome to controller: '. __("plugins.robot-log::app.name");
    }
}
