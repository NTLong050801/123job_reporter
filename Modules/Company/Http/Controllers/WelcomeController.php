<?php


namespace Modules\Company\Http\Controllers;

use App\Http\Controllers\AdminBaseController;

class WelcomeController extends AdminBaseController
{
    // return trang index sau khi đăng nhập
    public function index()
    {
        return view('company::view');
    }
}
