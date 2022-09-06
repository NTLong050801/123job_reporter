<?php
namespace Workable\Organization\Http\Controllers\Api;
use Illuminate\Routing\Controller;

class OrganizationApiBaseController extends Controller
{
    public function index()
    {
        return 'Welcome to controller api: '. __("plugins.organization::app.name");
    }
}
