<?php

namespace Workable\Organization\Http\Controllers;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Workable\Organization\Enum\CompanyStatusEnum;
use Workable\Organization\Http\Requests\CompanyRequest;
use Workable\Organization\Services\CompanyService;

class CompanyController extends AdminBaseController
{
    protected $viewPath = 'plugins.organization::pages.company';

    protected $companyService;

    /**
     * CompanyController constructor.
     * @param CompanyService $companyService
     */
    public function __construct(CompanyService $companyService)
    {
        parent::__construct();
        $this->companyService = $companyService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->setFilter($request, 'name', 'LIKE');
        $this->setFilter($request, 'status', '=');

        $filter = $this->getFilter();
        $items  = $this->companyService->list($filter);

        $viewData = [
            'items' => $items,
            'status' => CompanyStatusEnum::$statusText,
            'query' => $request->query()
        ];
        return $this->renderView('index')->with($viewData);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($companyId)
    {
        $viewData = [
            'item' => $this->companyService->findOne($companyId),
            'companies' => $this->companyService->listChildLevel(),
            'status' => CompanyStatusEnum::$statusText,
        ];
        return view($this->viewPath . '.edit')->with($viewData);
    }

    /**
     * @param $id
     * @param CompanyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, CompanyRequest $request)
    {
        $companySelect = $this->companyService->findOne($id);
        if (!$companySelect) abort(404);

        $redirect        = $request->get('redirect');
        $data            = $request->except(['_token', 'redirect']);
        $companyParentId = (int)$data['parent_id'];
        $companyParent   = $companyParentId ? $this->companyService->findOne($companyParentId) : 0;

        // Khong cho phep ch???n b???n th??n vs c???p d?????i l??m con
        if ($companyParent && $id == $companyParent->parent_id) {
            self::message('danger', "C???p nh???t c??ng ty th???t b???i - (parent-id)");
            return redirect()->back();
        }

        $this->companyService->update($id, $data);

        self::message('info', "C???p nh???t th??nh c??ng");
        return $this->redirect($redirect);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $viewData = [
            'companies' => $this->companyService->listChildLevel(),
            'status' => CompanyStatusEnum::$statusText,
        ];
        return $this->renderView('create')->with($viewData);
    }

    /**
     * @param CompanyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CompanyRequest $request)
    {
        $redirect = $request->get('redirect');
        $data     = $request->except(['_token', 'redirect']);
        $this->companyService->insert($data);

        self::message('success', "Th??m th??nh c??ng c??ng ty");
        return $this->redirect($redirect);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $this->companyService->delete($id);
        return $this->redirect(1);
    }

    /**
     * @param $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect($redirect)
    {
        switch ($redirect) {
            case 0:
                return redirect()->back();
                break;

            case 1:
                return redirect()->route('get.company.index');
                break;
        }
    }
}
