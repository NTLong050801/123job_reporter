<?php
namespace Workable\Employee\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class EmployeeApiBaseController extends Controller
{
    public function index()
    {
        return 'Welcome to controller api: '. __("plugins.employee::app.name");
    }
}
