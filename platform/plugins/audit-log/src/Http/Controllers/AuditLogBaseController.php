<?php
namespace Workable\AuditLog\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;

class AuditLogBaseController extends AdminBaseController
{
    protected $viewPath = 'plugins.audit-log::pages';
    protected $routeList = '';

    public function index(Request $request)
    {
        return 'Welcome to controller: '. __("plugins.audit-log::app.name");
    }
}
