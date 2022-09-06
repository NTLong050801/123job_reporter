<?php
namespace Workable\Candidate\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;

class CandidateBaseController extends AdminBaseController
{
    protected $viewPath = 'plugins.candidate::pages';
    protected $routeList = '';

    public function index(Request $request)
    {

    }
}
