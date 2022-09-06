<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Workable\Support\Traits\FilterBuilderTrait;
use Workable\Support\Traits\FlashMessages;
use function view;

class AdminBaseController extends Controller
{
    use FlashMessages;

    use FilterBuilderTrait;

    public function __construct()
    {

    }

    public function renderView($viewName, $separator='.')
    {
          // dd($this->viewPath . $separator .$viewName);

        return view($this->viewPath . $separator .$viewName);
    }

    /**
     * @param $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirect($redirect)
    {
        switch ($redirect) {
            case 0:
                return redirect()->back();
                break;

            case 1:
                return redirect()->route($this->routeList);
                break;
        }
    }
}
