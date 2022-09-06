<?php


namespace Modules\Company\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;

class TemplateController extends BaseController
{
    public function index()
    {
        return view('company::template.index');
    }
}
