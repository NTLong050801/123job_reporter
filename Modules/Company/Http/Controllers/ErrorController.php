<?php


namespace Modules\Company\Http\Controllers;


use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;

class ErrorController extends AdminBaseController
{
    public function denied()
    {
        return view('company::error.403');
    }

    public function show404(Request $request)
    {
        return view('company::error.404');
    }
}
