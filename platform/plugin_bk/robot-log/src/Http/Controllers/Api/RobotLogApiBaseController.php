<?php
namespace Workable\RobotLog\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class RobotLogApiBaseController extends Controller
{
    public function index()
    {
        return 'Welcome to controller api: '. __("plugins.robot-log::app.name");
    }
}
