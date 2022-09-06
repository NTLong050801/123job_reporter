<?php

namespace Modules\Collect\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class CollectController extends Controller
{

    public function index()
    {
        dd(1);
        return view('collect::index');
    }
}
