<?php
namespace Workable\Candidate\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CandidateApiBaseController extends Controller
{
    public function index()
    {

        return 'Welcome to controller api: '. __("plugins.candidate::app.name");
    }

}
