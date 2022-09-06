<?php

namespace Workable\Attribute\Http\Controllers;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Workable\Attribute\Enum\AttributeStatusEnum;
use Workable\Attribute\Enum\AttributeTypeEnum;
use Workable\Attribute\Http\Requests\AttributeRequest;
use Workable\Attribute\Services\AttributeService;

class AttributeController extends AdminBaseController
{
    protected $viewPath = 'plugins.attribute::backend';
    protected $routeList = 'get.adm_attr.index';
    protected $attributeService;

    public function __construct(AttributeService $attributeService)
    {
        parent::__construct();
        $this->attributeService = $attributeService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->setFilter($request, 'name', 'LIKE');
        $this->setFilter($request, 'id', '=');
        $this->setFilter($request, 'type', '=');
        $filter = $this->getFilter();
        $viewData = [
            'items' => $this->attributeService->list($filter),
            'types' => AttributeTypeEnum::$statusText,
            'query' => $request->query()
        ];
        return $this->renderView('index')->with($viewData);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->attributeService->findById($id);
        $viewData = [
            'status' => AttributeStatusEnum::$statusText,
            'type' => AttributeTypeEnum::$statusText,
            'item' => $item
        ];
        return $this->renderView('edit')->with($viewData);
    }

    /**
     * @param AttributeRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AttributeRequest $request, $id)
    {
        $this->attributeService->findById($id);
        $redirect = $request->get('redirect');
        $data = $request->except(['_token', 'redirect']);
        $this->attributeService->update($id, $data);
        self::message("success", "Update thành công");
        return $this->redirect($redirect);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $viewData = [
            'status' => AttributeStatusEnum::$statusText,
            'type' => AttributeTypeEnum::$statusText,
            'item' => null
        ];
        return $this->renderView('create')->with($viewData);
    }

    /**
     * @param AttributeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AttributeRequest $request)
    {
        $redirect = $request->get('redirect');
        $data = $request->except(['_token', 'redirect']);
        $this->attributeService->insert($data);
        self::message("success", "Thêm thành công");
        return $this->redirect($redirect);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status(Request $request, $id)
    {
        $this->attributeService->status($id, $request->get('status'));
        return $this->redirect(0);
    }
}
