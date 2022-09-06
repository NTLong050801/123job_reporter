<?php
namespace Workable\JobRecruit\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;

class JobRecruitBaseController extends AdminBaseController
{
    protected $viewPath = 'plugins.job-recruit::pages';
    protected $routeList = '';

    public function index(Request $request)
    {
        return 'Welcome to controller: '. __("plugins.job-recruit::app.name");
    }
}
