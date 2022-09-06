<?php

namespace Workable\Acl\Repository\Permission;

use Illuminate\Support\Facades\DB;
use Workable\Acl\Enum\RoleEnum;
use Workable\Employee\Models\Admin;
use Workable\Acl\Models\Permission;
use Workable\Acl\Models\AdminRolePermission;
use Workable\Acl\Models\Role;
use Workable\Support\Repositories\Eloquent\BaseRepository;


class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    protected $model;
    protected $id;

    public function __construct(Permission $adminMenu)
    {
        $this->model = $adminMenu;
    }

    public function list($filter= false, $sort= false, $limit=false){
        $query = $this->model;
        $query = $this->scopeFilter($query,$filter);
        $query = $this->scopeSort($query, $sort);
        return $limit? $query->paginate($limit) : $query->get();
    }

    public function getList($filter = [])
    {
        $moduleId    = $filter['menu_id'] ?? 0;
        $showSidebar = $filter['show_sidebar'] ?? 0;
        $quering     = $this->model->where('status', 1);
        if ($moduleId) {
            $quering->where('menu_id', $moduleId);
        }

        if ($showSidebar) {
            $quering->where('show_sidebar', $showSidebar);
        }

        return $quering->orderBy('id', 'asc')
            ->get()
            ->keyBy('id');
    }

    public function getListAll($params = [], $field = ['*'], $paginate = 20)
    {
        $filter = $params['filter'] ?? [];
        $query  = $this->model->with('admin:id,name', 'roles:id', 'admins:id');

        if ($filter) {
            $query = $this->scopeFilter($query, $filter);
        }

        $items = $query->orderBy('id', 'desc')
            ->get();

        return $items;
    }

    public function getPermissionByRole($filter=false, $sort = false)
    {
        $query = $this->model;
        $query = $this->scopeFilter($query, $filter);
        $query = $this->scopeSort($query, $sort);
        $items=$query->whereHas('roleUser', function ($q){
            $q->where('admin_id', get_data_user('admins', 'id'))
                ->where('admin_role_user.active', 1)
                ->where('admin_role_permission.active',1);
        })->get();
        return $items;
    }

    public function getPermissionByUser($filter=false, $sort = false){
        $query = $this->model;
        $query = $this->scopeFilter($query, $filter);
        $query = $this->scopeSort($query, $sort);
        $items = $query->whereHas('admins', function ($q) {
            $q->where('admin_permission_user.admin_id', get_data_user('admins', 'id'))
                  ->where('admin_permission_user.active', 1);
        })->get();
        return $items;
    }

    public function insertData($data = [])
    {
        return $this->insert($data);
    }

    public function updateHasChild($id)
    {
        return $this->update($id, [
            'has_child' => 1
        ]);
    }

    public function disableAllChild($column, $value, $data = [])
    {
        if ($column) {
            return $this->updateBy($column, $value, $data);
        }
    }

    public function getRolePermission($id)
    {
        $this->id = $id;
        $items    = Role::whereHas('permissions', function ($query) {
            $query->where('permission_id', $this->id)->where('active', 1);
        })
            ->orWhere('id', 1)->get();
        return $items;
    }

    public function getUserPermission($id)
    {
        $this->id = $id;
        $items    = Admin::whereHas('adminPermission', function ($query) {
            $query->where('permission_id', $this->id)->where('admin_role_user.active', 1);
        })
            ->orWhereHas('roles', function ($query) {
                $query->where('role_id', 1);
            })
            ->get();
        return $items;
    }

    public function getUserPermission2($id)
    {
        $this->id = $id;
        $items    = Admin::whereHas('permissions', function ($query) {
            $query->where('permission_id', $this->id)->where('active', 1);
        })->get();
        return $items;
    }

    public function updateRole($permission, $role)
    {
        AdminRolePermission::where([['role_id', '=', $role], ['permission_id', '=', $permission]])->update(['active' => 0]);
    }

    public function updateUser($permission, $user)
    {
        $query = $this->model;
        DB:: table('admin_permission_user')
            ->where([['admin_id', '=', $user], ['permission_id', '=', $permission]])
            ->update(['active' => 0]);
        $query:: where('id', $permission)->decrement('number_user', 1);
    }

    public function increaseNumberUser($roles_id = [], $permissions_id = [])
    {
        // dd(1, $roles_id);
        if (count($roles_id) != 0) {
            if ($roles_id[0] == RoleEnum::SUPER_ADMIN_ID) {
                $this->model:: where('id', '<>', 0)->increment('number_user', 1);
            } else {
                $this->model::whereHas('roles', function ($query) use ($roles_id) {
                    $query->whereIn('role_id', $roles_id);
                })->increment('number_user', 1);
            }
        }
        if (count($permissions_id) != 0) {
            $this->model:: whereIn('id', $permissions_id)->increment('number_user', 1);
        }
    }
    public function decreaseNumberUser($roles_id = [], $permissions_id = [])
    {
        if (count($roles_id) != 0) {
            if ($roles_id[0] == RoleEnum::SUPER_ADMIN_ID) {
                $this->model:: where('id', '<>', 0)->decrement('number_user', 1);
            } else {
                $this->model::whereHas('roles', function ($query) use ($roles_id) {
                    $query->whereIn('role_id', $roles_id);
                })->decrement('number_user', 1);
            }
        }
        if (count($permissions_id) != 0) {
            $this->model:: whereIn('id', $permissions_id)->decrement('number_user', 1);
        }
    }
}
