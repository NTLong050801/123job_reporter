<?php
namespace Workable\System\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class SystemApiBaseController extends Controller
{
    public function index()
    {
        return 'Welcome to controller api: '. __("plugins.system::app.name");
    }
}
