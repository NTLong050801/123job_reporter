<?php

namespace Workable\Acl\Repository\Role;

use Workable\Employee\Models\Admin;
use Workable\Acl\Models\Permission;
use Workable\Acl\Models\Role;
use Workable\Employee\Models\AdminRoleUser;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    protected $model;

    public function __construct(Role $permission)
    {
        $this->model = $permission;
    }

    public function getList($filter=[], $field = ['*'], $paginate = 10)
    {
        $query = $this->model->with('admin:id,name', 'company:id,name');
        if ($filter)
        {
            $query = $this->scopeFilter($query, $filter);
        }
        $items = $query->orderBy('id', 'desc')
                        ->paginate($paginate);

        return $items;
    }

    public function getListSlug()
    {
        $query = $this->model->pluck('name', 'id')->all();

        return $query;
    }

    public function destroy($id)
    {
        return $this->model::destroy($id);
    }

    public function createRole($dataInsert)
    {
        $dataUpdate = sc_clean($dataInsert, 'password');
        return $this->model::create($dataUpdate);
    }

    public function getUser($id)
    {
        $item = Admin::whereHas('roles', function($query) use ($id){
            $query->where('role_id', $id)->where('active', 1);
        })->get();

        return $item;
    }

    public function getPermission($id)
    {
        $item = Permission::whereHas('roles', function($query) use ($id){
            $query->where('role_id', $id)->where('active', 1);
        })->get();

        return $item;
    }

    public function roleAdminUpdate($role, $user)
    {
        AdminRoleUser::where([['role_id', $role], ['admin_id', $user]])
                            ->update(['active'=>0]);
    }

    public function increaseNumberUser($roles_id){
        $this->model::whereIn('id', $roles_id)->increment('number_user', 1);
    }

    public function decreaseNumberUser($roles_id){
        $this->model::whereIn('id', $roles_id)->decrement('number_user', 1);
    }
}
