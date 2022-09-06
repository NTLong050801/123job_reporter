<?php

namespace Workable\Organization\Http\Controllers;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Workable\Organization\Enum\DepartmentStatusEnum;
use Workable\Organization\Http\Requests\DepartmentRequest;
use Workable\Organization\Services\CompanyService;
use Workable\Organization\Services\DepartmentService;

class DepartmentController extends AdminBaseController
{
    protected $departmentService;
    protected $companyService;

    protected $viewPath = 'plugins.organization::pages.department';

    /**
     * DepartmentController constructor.
     * @param DepartmentService $departmentService
     * @param CompanyService $companyService
     */
    public function __construct(DepartmentService $departmentService,
                                CompanyService $companyService)
    {
        parent::__construct();
        $this->departmentService = $departmentService;
        $this->companyService = $companyService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->setFilter($request, 'company_id', '=');
        $this->setFilter($request, 'status', '=');

        $filter = $this->getFilter();
        $items = $this->departmentService->listChildTable($filter);

        $viewData = [
            'companies' => $this->companyService->listChildLevel(),
            'items' => $items,
            'status' => DepartmentStatusEnum::$statusText,
            'query' => $request->query()
        ];
        return $this->renderView('index')->with($viewData);
    }

    public function listChildLevel(Request $request)
    {
        $filter = [
            ['company_id', '=', $request->company_id],
        ];
        if ($request->parent_id) {
            $filter = [
                ['parent_id', '=', $request->parent_id]
            ];
        }
        $items = $this->departmentService->listChildLevel($filter);
        $viewData = [
            'items' => $items,
            'query' => $request->query(),
        ];
        return view($this->viewPath . '.include._inc_option')->with($viewData);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $viewData = [
            'companies' => $this->companyService->listChildLevel(),
            'item' => $this->departmentService->findById($id),
            'status' => DepartmentStatusEnum::$statusText
        ];
        return $this->renderView('edit')->with($viewData);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $viewData = [
            'companies' => $this->companyService->listChildLevel(),
            'status' => DepartmentStatusEnum::$statusText
        ];
        return $this->renderView('create')->with($viewData);
    }

    /**
     * @param $id
     * @param DepartmentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, DepartmentRequest $request)
    {
        $item = $this->departmentService->findById($id);
        if (!$item) abort(404);

        $redirect = $request->get('redirect');
        $data = $request->except(['_token', 'redirect']);
        $this->departmentService->update($id, $data);

        self::message("success", "Chỉnh sửa thành công");
        return $this->redirect($redirect);
    }

    /**
     * @param DepartmentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DepartmentRequest $request)
    {
        $redirect = $request->get('redirect');
        $data = $request->except(['_token', 'redirect']);
        $this->departmentService->store($data);
        self::message("success", "Thêm thành công");

        return $this->redirect($redirect);
    }

    public function stop($id)
    {
        $item = $this->departmentService->findById($id);
        if (!$item) abort(404);
        $this->departmentService->stop($id);
        return $this->redirect(0);
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
                return redirect()->route('get.department.index');
                break;
        }
    }
}
