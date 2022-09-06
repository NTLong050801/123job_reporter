<?php

namespace Workable\Acl\Services;

use Illuminate\Support\Facades\Cache;
use Workable\Acl\Enum\PermissionStatusEnum;
use Workable\Acl\Models\Permission;
use Workable\Acl\Repository\Permission\PermissionRepositoryInterface;
use Workable\Employee\Models\Admin;
use Workable\Employee\Models\AdminPermissionUser;
use Workable\Employee\Traits\CacheTrait;
use Workable\Support\Traits\RecursiveClassTrait;

class PermissionService
{
    use RecursiveClassTrait, CacheTrait;

    protected $permissionRepository;
    protected $menuId = 0;


    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->menuId               = config('menu.menu_id');
        $this->permissionRepository = $permissionRepository;
    }

    public function forgetItem($listMenu, $listItemForget)
    {
        foreach ($listItemForget as $item) {
            $listMenu = $listMenu->forget($item);
        }
        return $listMenu->toArray() ?? [];
    }

    public function getListMenu()
    {
        $menu_key  = 'admin_sidebar.' . $this->menuId;
        $cache_key = $this->makeKeyCache($menu_key, get_data_user('admins', 'id'));
        $listmenu  = Cache::remember($cache_key, 20, function () {
            $isAdmin = Admin::user()->isAdministrator();

            $filter = [
                ['menu_id', '=', $this->menuId],
                ['status', '=', 1],
                ['show_sidebar', '=', 1]
            ];
            $sort   = [['sort', 'desc'], ['id', 'asc']];
            if ($isAdmin) {
                $list = $this->permissionRepository->list($filter, $sort);
            } else {
                $list1 = $this->permissionRepository->getPermissionByRole($filter, $sort);
                // dd($list1, $filter);
                $list2 = $this->permissionRepository->getPermissionByUser($filter, $sort);
                $list  = $list1->merge($list2);
            }
            // dd($list1->toArray(), $list2->toArray());
            return $this->sort($list);
        });
        return $listmenu;
    }

    public function getList($param = [])
    {
        $items = $this->permissionRepository->getListAll($param);
        return $items;
    }

    public function insert($data = [])
    {
        $data['sort']       = (int)$data['sort'];
        $data['parent_id']  = (int)$data['parent_id'];
        $data['created_at'] = now();
        $data['updated_at'] = now();
        $this->permissionRepository->insertData($data);
        $this->permissionRepository->updateHasChild($data['parent_id']);
    }

    public function update($id, $data = [])
    {
        $data['parent_id']  = (int)$data['parent_id'];
        $data['sort']       = (int)$data['sort'];
        $data['updated_at'] = now();
        return $this->permissionRepository->update($id, $data);
    }

    public function findOne($id)
    {
        return $this->permissionRepository->find($id);
    }

    public function delete($id, $hasChild)
    {
        $this->permissionRepository->update($id, [
            'status' => PermissionStatusEnum::STATUS_DELETE
        ]);

        // Hide all child
        if ($hasChild) {
            $this->permissionRepository->disableAllChild('parent_id', $id, [
                'status' => PermissionStatusEnum::STATUS_DELETE
            ]);
        }
    }

    public function findAllChildId($id)
    {
        return $this->permissionRepository->findAllChild($id);
    }

    public function getRolePermission($id)
    {
        return $this->permissionRepository->getRolePermission($id);
    }

    public function getUserPermission($id)
    {
        return $this->permissionRepository->getUserPermission($id);
    }

    public function getUserPermission2($id)
    {
        return $this->permissionRepository->getUserPermission2($id);
    }

    public function updateRole($permission, $role)
    {
        $this->permissionRepository->updateRole($permission, $role);
    }

    public function updateUser($permission, $user)
    {
        $parent      = Permission::find($permission);
        $child       = Permission::where('parent_id', $parent->parent_id)->pluck('id')->toArray();
        $total_child = AdminPermissionUser::whereIn('permission_id', $child)->get();
        if ($total_child->count() > 1) {
            $this->permissionRepository->updateUser($permission, $user);
        } else {
            $this->permissionRepository->updateUser($permission, $user);
            $this->permissionRepository->updateUser($parent->parent_id, $user);
        }
    }
}
