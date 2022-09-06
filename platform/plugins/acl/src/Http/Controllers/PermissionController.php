<?php


namespace Workable\Acl\Http\Controllers;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;

use Workable\Acl\Enum\PermissionStatusEnum;
use Workable\Employee\Models\Admin;
use Workable\Acl\Models\Permission;
use Workable\Acl\Models\Role;
use Modules\Company\Services\MenuService;
use Workable\Acl\Services\AdminPermissionService;
use Workable\Acl\Services\PermissionService;
use Workable\AuditLog\Facades\AuditLogFacade;
use Workable\Employee\Enum\AdminEnum;

class PermissionController extends AdminBaseController
{
    protected $activity = ['store', 'update'];
    protected $permissionService;
    protected $menuService;
    protected $adminPermissionService;
    protected $viewPath = 'plugins.acl::pages.permission';


    public function __construct(
        PermissionService $permissionService,
        MenuService $menuService,
        AdminPermissionService $adminPermissionService
    ) {
        parent::__construct();
        $this->permissionService = $permissionService;
        $this->menuService = $menuService;
        $this->adminPermissionService = $adminPermissionService;
    }

    public function index(Request $request)
    {
        // can('get.per');
        $this->setFilter($request, 'uri', '=');
        $this->setFilter($request, 'menu_id', '=');
        $this->setFilter($request, 'admin_id', '=');
        $filter = $this->getFilter();

        $params = [
            'filter' => $filter
        ];
        $viewData = [
            'permissions' => $this->permissionService->getList($params),
            'menus'       => $this->menuService->list(),
            'query'       => $request->query(),
        ];

        return $this->renderView('index')->with($viewData);
    }

    public function assignRole(Request $request)
    {
        $viewData = [
            'roles'       => Role::with('permissions:id')->get(),
            'permissions' => Permission::where('status', PermissionStatusEnum::STATUS_SHOW)->get(),
            'menus'       => $this->menuService->list(),
        ];
        return $this->renderView('assign_role')->with($viewData);
    }

    public function assignAdmin(Request $request)
    {
        $adminId = $request->get('admin_id', 0);
        if ($adminId) {
            $admin = Admin::with('roles:id,name')->find($adminId);
            $rolePermission = array_unique($admin->roles()->with('permissions')->get()->pluck('permissions')
                ->flatten()->pluck('id')->toArray());
            $adminPermission = $admin->permissions()->get()->pluck('id')->toArray();
        }
        $viewData = [
            'permissions'     => Permission::where('status', PermissionStatusEnum::STATUS_SHOW)->get(),
            'menus'           => $this->menuService->list(),
            'admins'          => Admin::where('active', AdminEnum::STATUS_ACTIVE)->get(),
            'admin'           => $admin ?? null,
            'rolePermission'  => $rolePermission ?? [],
            'adminPermission' => $adminPermission ?? [],
        ];

        return $this->renderView('assign_admin')->with($viewData);
    }

    public function ajaxAssignRole(Request $request)
    {
        $check = $request->get('check', 0);
        $id = $request->get('id', null);
        $permission = $request->get('permission', null);

        if ($id && $permission) {
            if (!$check) {
                $this->adminPermissionService->deletePermissionForRole($id, $permission);
                return response()->json(['success' => 'Xóa quyền của vai trò thành công!']);
            } else {
                $this->adminPermissionService->addPermissionForRole($id, $permission);
                return response()->json(['success' => 'Thêm quyền cho vai trò thành công!']);
            }
        }

        return response()->json(['error' => 'Có lỗi xảy ra, vui lòng thử lại sau']);
    }

    public function ajaxAssignAdmin(Request $request)
    {
        $check = $request->get('check', 0);
        $id = $request->get('id', null);
        $permission = $request->get('permission', null);
        // dump($permission);
        // $permission = json_decode($permissionId);
        if ($id && $permission) {
            if (!$check) {
                $this->adminPermissionService->deletePermissionForAdmin($id, $permission);
                return response()->json(['success' => 'Xóa quyền của admin thành công!']);
            } else {
                $this->adminPermissionService->addPermissionForAdmin($id, $permission);
                return response()->json(['success' => 'Thêm quyền cho admin thành công!']);
            }
        }

        return response()->json(['error' => 'Có lỗi xảy ra, vui lòng thử lại sau']);
    }

    public function permissionRole($id)
    {

        $viewData = [
            'rolePermission' => $this->permissionService->getRolePermission($id),
            'permission'     => $this->permissionService->findOne($id),
        ];
        // dd($viewData);
        return $this->renderView('permission_role')->with($viewData);
    }

    public function permissionAdmin($id)
    {

        $viewData = [
            'user_permission1' => $this->permissionService->getUserPermission($id),
            'user_permission2' => $this->permissionService->getUserPermission2($id),
            'permission'       => $this->permissionService->findOne($id),
        ];
        // dd($viewData);
        return $this->renderView('permission_admin')->with($viewData);
    }

    public function permissionRoleUpdate(Request $request, $permission, $role)
    {
        $redirect = $request->get('redirect');
        $this->permissionService->updateRole($permission, $role);
        self::message('info', 'Update thành công');
        return $this->redirect($redirect);
    }

    public function permissionAdminUpdate(Request $request, $permission, $user)
    {
        $redirect = $request->get('redirect');
        $this->permissionService->updateUser($permission, $user);
        $data['id']=$permission;
        $data['user']= $user;
        AuditLogFacade::screen("user-permission")
        ->request($request)
        ->data((object)$data)
        ->deleted();
        self::message('info', 'Update thành công');
        return $this->redirect($redirect);
    }
}
