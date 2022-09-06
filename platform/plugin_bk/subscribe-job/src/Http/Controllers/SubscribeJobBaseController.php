<?php
namespace Workable\SubscribeJob\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;

class SubscribeJobBaseController extends AdminBaseController
{
    protected $viewPath = 'plugins.subscribe-job::pages';
    protected $routeList = '';

    public function index(Request $request)
    {
        return 'Welcome to controller: '. __("plugins.subscribe-job::app.name");
    }
}
