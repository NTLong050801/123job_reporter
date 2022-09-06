<?php
namespace Workable\GoogleLog\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class GoogleLogApiBaseController extends Controller
{
    public function index()
    {
        return 'Welcome to controller api: '. __("plugins.google-log::app.name");
    }
}
