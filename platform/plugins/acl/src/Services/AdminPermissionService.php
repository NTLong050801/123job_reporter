<?php

namespace Workable\Acl\Services;


use Workable\Acl\Models\AdminRolePermission;
use Workable\Acl\Repository\Permission\PermissionRepositoryInterface;
use Workable\Acl\Repository\Role\RoleRepositoryInterface;
use Workable\Employee\Models\AdminPermissionUser;

class AdminPermissionService
{
    protected  $roleRepository,
        $permissionRepository;
    public function __construct(
        RoleRepositoryInterface $roleRepository,
        PermissionRepositoryInterface $permissionRepository
    ) {
        $this->roleRepository       = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }
    public function addPermissionForRole(int $role_id, $permission_id)
    {
        $role_list = AdminRolePermission::where('role_id', '=', $role_id)->pluck('permission_id')->toArray();
        foreach ($permission_id as $item) {
            if (!in_array((int)$item, $role_list)) {
                AdminRolePermission::insert([
                    [
                        'role_id'       => $role_id,
                        'permission_id' => (int) $item,
                        'created_at'    => \Carbon\Carbon::now(),
                        'active'        => 1
                    ]
                ]);
            } else {
                AdminRolePermission::where('role_id', $role_id)->where('permission_id', $item)->update([
                    'active'     => 1,
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
        }
    }

    public function deletePermissionForRole(int $role_id,  $permission_id)
    {
        AdminRolePermission:: where('role_id', $role_id)
            ->whereIn('permission_id', $permission_id)
            ->update(['active' => 0, 'updated_at'    => \Carbon\Carbon::now(),]);
    }

    public function addPermissionForAdmin(int $adminId, $permissionId)
    {
        $permission_active = [];
        $user_list         = AdminPermissionUser::where('admin_id', '=', $adminId)->pluck('permission_id')->toArray();
        foreach ($permissionId as $item) {
            if (!in_array((int)$item, $user_list)) {
                AdminPermissionUser::insert([
                    [
                        'admin_id'      => $adminId,
                        'permission_id' => (int) $item,
                        'created_at'    => \Carbon\Carbon::now(),
                        'updated_at'    => \Carbon\Carbon::now(),
                        'active'        => 1
                    ]
                ]);
                array_push($permission_active, $item);
            } else {
                AdminPermissionUser::where('admin_id', $adminId)->where('permission_id', $item)->update([
                    'active'     => 1,
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
                array_push($permission_active, $item);
            }
            $this->permissionRepository->increaseNumberUser([], $permission_active);
        }
    }

    public function deletePermissionForAdmin(int $adminId,  $permissionId)
    {
        AdminPermissionUser:: where('admin_id', $adminId)
            ->whereIn('permission_id', $permissionId)
            ->update(['active' => 0, 'updated_at'    => \Carbon\Carbon::now(),]);
        $this->permissionRepository->decreaseNumberUser([], $permissionId);
    }

    public function addRoleForAdmin(int $adminId, int $roleId)
    {
        \DB::table('admin_role_user')->insert([
            'admin_id'   => $adminId,
            'role_id'    => $roleId,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }

    public function deleteRoleForAdmin(int $adminId,  int $roleId)
    {
        \DB:: table('admin_role_user')
            ->where('admin_id', $adminId)
            ->where('role_id', $roleId)
            ->delete();
    }
}
