<?php
namespace Workable\JobRecruit\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class JobRecruitApiBaseController extends Controller
{
    public function index()
    {
        return 'Welcome to controller api: '. __("plugins.job-recruit::app.name");
    }
}
