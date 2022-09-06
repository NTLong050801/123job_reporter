<?php
namespace Workable\Menu\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class MenuApiBaseController extends Controller
{
    public function index()
    {
        return 'Welcome to controller api: '. __("plugins.menu::app.name");
    }
}
