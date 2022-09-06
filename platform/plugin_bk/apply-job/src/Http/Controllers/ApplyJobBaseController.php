<?php
namespace Workable\ApplyJob\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;

class ApplyJobBaseController extends AdminBaseController
{
    protected $viewPath = 'plugins.apply-job::';
    protected $routeList = '';

    public function index(Request $request)
    {
        $viewData = [

        ];
        return view($this->viewPath.'.dashboard')->with($viewData);
    }
}
