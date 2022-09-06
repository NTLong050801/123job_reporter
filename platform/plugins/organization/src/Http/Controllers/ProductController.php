<?php


namespace Workable\Organization\Http\Controllers;


use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Workable\Organization\Enum\ProductStatusEnum;
use Workable\Organization\Enum\ProductTypePaymentEnum;
use Workable\Organization\Http\Requests\ProductRequest;
use Workable\Organization\Services\CompanyService;
use Workable\Organization\Services\ProductService;

class ProductController extends AdminBaseController
{
    protected $viewPath = 'plugins.organization::pages.product';
    protected $productService;
    protected $companyService;

    public function __construct(
        CompanyService $companyService,
        ProductService $productService)
    {
        parent::__construct();
        $this->productService = $productService;
        $this->companyService = $companyService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->setFilter($request, 'id', '=');
        $this->setFilter($request, 'name', 'LIKE');
        $this->setFilter($request, 'status', '=');

        $filter = $this->getFilter();
        $viewData = [
            'query' => $request->query(),
            'status' => ProductStatusEnum::$statusText,
            'items' => $this->productService->list($filter)
        ];
        return $this->renderView('index')->with($viewData);
    }

    /**
     * @param Request $request
     * @return string
     * @throws \Throwable
     */
    public function listProduct(Request $request)
    {
        $companyId = $request->get('companyId');
        $parentId = $request->get('parentId');

        $items = $this->productService->listByCompanyId($companyId);
        $viewData = [
            'items' => $items,
            'parent_id' => $parentId
        ];
        return $this->renderView('include._inc_product')->with($viewData);
        // return view($this->viewPath . '.include._inc_product')->with($viewData)->render();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $viewData = [
            'companies' => $this->companyService->listChildLevel(),
            'types' => ProductTypePaymentEnum::$statusText,
            'status' => ProductStatusEnum::$statusText
        ];
        // return view($this->viewPath . '.create')->with($viewData);
        return $this->renderView('create')->with($viewData);
    }

    /**
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $redirect = $request->get('redirect');
        $data = $request->except(['_token', 'redirect']);
        $this->productService->store($data);
        self::message("success", "Thêm mới thành công");

        return $this->redirect($redirect);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $viewData = [
            'companies' => $this->companyService->listChildLevel(),
            'item' => $this->productService->findById($id),
            'types' => ProductTypePaymentEnum::$statusText,
            'status' => ProductStatusEnum::$statusText
        ];
        return $this->renderView('edit')->with($viewData);
    }

    /**
     * @param $id
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, ProductRequest $request)
    {
        $redirect = $request->get('redirect');
        $data = $request->except(['_token', 'redirect']);
        $this->productService->update($id, $data);
        self::message("success", "Chỉnh sửa thành công");
        return $this->redirect($redirect);
    }

    public function stop($id)
    {
        $productItem = $this->productService->findById($id);
        $totalChildActive = $this->productService->countChild($productItem->id);
        if ($totalChildActive) {
            self::message("warning", "Không thể dừng. Vẫn tồn tại sản phẩm con hoạt động");
        } else {
            $this->productService->stop($id);
        }
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
                return redirect()->route('get.product.index');
                break;
        }
    }
}
