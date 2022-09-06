<?php
namespace Workable\ManagerSite\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ManagerSiteApiBaseController extends Controller
{
    public function index()
    {
        return 'Welcome to controller api: '. __("plugins.manager-site::app.name");
    }
}
