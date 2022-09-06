<?php
namespace Workable\Acl\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class aclApiBaseController extends Controller
{
    public function index()
    {
        return 'Welcome to controller api: '. __("plugins.acl::app.name");
    }
}
