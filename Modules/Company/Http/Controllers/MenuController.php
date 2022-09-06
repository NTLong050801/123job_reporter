<?php


namespace Modules\Company\Http\Controllers;


use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Modules\Company\Enum\MenuStatusEnum;
use Modules\Company\Http\Requests\MenuRequest;
use Modules\Company\Services\MenuService;

class MenuController extends AdminBaseController
{
    protected $viewPath = 'company::pages.menu';
    protected $menuService;

    /**
     * ModuleController constructor.
     * @param ModuleService $menuService
     */
    public function __construct(MenuService $menuService)
    {
        parent::__construct();
        $this->menuService = $menuService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->setFilter($request, 'menu_name', 'LIKE');
        $this->setFilter($request, 'menu_status', '=', null);
        $filter = $this->getFilter();
        $viewData = [
            'items' => $this->menuService->list($filter)
        ];
        return view('company::pages.menu.index')->with($viewData);
    }

    public function dashboard()
    {
        return view('company::view');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->menuService->firstById($id);
        $viewData = [
            'item' => $item,
            'status' => MenuStatusEnum::$statusText
        ];
        return view('company::pages.menu.edit')->with($viewData);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, MenuRequest $request)
    {
        $redirect = $request->get('redirect');
        $data = $request->except(['_token', 'redirect']);
        $this->menuService->update($id, $data);
        self::message('info','update thành công');
        return $this->redirect($redirect);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $viewData = [
            'status' => MenuStatusEnum::$statusText
        ];
        return view('company::pages.menu.create')->with($viewData);
    }

    /**
     * @param ModuleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MenuRequest $request)
    {
        $redirect = $request->get('redirect');
        $data = $request->except(['_token', 'redirect']);
        $this->menuService->insert($data);

        return $this->redirect($redirect);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $this->menuService->delete($id);
        return redirect()->back();
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
                return redirect()->route('get.menu.index');
                break;
        }
    }
}
