<?php
namespace Workable\Acl\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;

class AclBaseController extends AdminBaseController
{
    protected $viewPath = 'plugins.acl::pages';
    protected $routeList = '';

    public function index(Request $request)
    {
        return 'Welcome to controller: '. __("plugins.acl::app.name");
    }
}
