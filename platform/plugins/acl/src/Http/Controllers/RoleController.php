<?php


namespace Workable\Acl\Http\Controllers;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Workable\Acl\Http\Requests\RoleRequest;
use Workable\Organization\Services\CompanyService;
use Workable\Acl\Services\RoleService;

class RoleController extends AdminBaseController
{
    private $roleService;
    private $companyService;
    protected $viewPath = 'plugins.acl::pages.role';

    public function __construct(
        RoleService $roleService,
        CompanyService $companyService
    ) {
        parent::__construct();
        $this->roleService    = $roleService;
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        $this->setFilter($request, 'name', 'LIKE');
        $this->setFilter($request, 'company_id', 'LIKE');
        $filter = $this->getFilter();

        $viewData = [
            'items' => $this->roleService->list($filter),
            'query' => $request->query(),
            'company' => [],
        ];

        return $this->renderView('index')->with($viewData);
    }

    public function edit($id)
    {
        $roleItem = $this->roleService->findById($id);
        $viewData = [
            'companies' => $this->companyService->listChildLevel(),
            'item' => $roleItem
        ];
        return $this->renderView('edit')->with($viewData);
    }

    public function update($id, RoleRequest $request)
    {
        $roleItem = $this->roleService->findById($id);
        $redirect = $request->get('redirect');
        $data = $request->except(['_token', 'redirect']);
        $this->roleService->update($roleItem->id, $data);

        return $this->redirect($redirect);
    }

    public function create()
    {
        $viewData = [
            'companies' => $this->companyService->listChildLevel()
        ];
        return $this->renderView('create')->with($viewData);
    }

    public function store(RoleRequest $request)
    {
        $redirect = $request->get('redirect');
        $data = $request->except(['_token', 'redirect']);
        $this->roleService->insert($data);
        return $this->redirect($redirect);
    }

    protected function redirect($redirect)
    {
        switch ($redirect) {
            case 0:
                return redirect()->back();
                break;

            case 1:
                return redirect()->route('get.role.index');
                break;
        }
    }

    public function roleAdmin($id)
    {
        $viewData =[
            'role'=> $this->roleService->findById($id),
            'users'=> $this->roleService->getUser($id),
        ];

        return $this->renderView('role_admin')->with($viewData);
    }

    public function roleAdminUpdate(Request $request, $role, $user)
    {
        $redirect = $request->get('redirect');
        $this->roleService->roleAdminUpdate($role, $user);
        self::message('info', 'Update thành công');
        return $this->redirect($redirect);
    }

    public function rolePermission($id)
    {
        $viewData =[
            'role'=> $this->roleService->findById($id),
            'permission'=> $this->roleService->getPermission($id),
        ];

        return $this->renderView('role_permission')->with($viewData);
    }
}
