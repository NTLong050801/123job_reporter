<?php

namespace Workable\Employee\Services;

use Illuminate\Support\Arr;
use Workable\Acl\Enum\RoleEnum;
use Workable\Acl\Repository\Permission\PermissionRepositoryInterface;
use Workable\Acl\Repository\Role\RoleRepositoryInterface;
use Workable\Employee\Enum\AdminEnum;
use Workable\Employee\Repository\Employee\EmployeeRepositoryInterface;
use Workable\Employee\Repository\RoleUser\RoleUserRepositoryInterface;

class EmployeeService
{
    protected $employeeRepository,
        $roleRepository,
        $roleUserRepository,
        $permissionRepository;
    protected $id;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        RoleRepositoryInterface $roleRepository,
        RoleUserRepositoryInterface $roleUserRepository,
        PermissionRepositoryInterface $permissionRepository
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->roleRepository     = $roleRepository;
        $this->roleUserRepository = $roleUserRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function list($filter = false, $sort = false, $paginate = 10)
    {
        $item = $this->employeeRepository->list($filter, $sort, $paginate);
        return $item;
    }

    public function getAll($filter = false, $sort = false, $paginate = 10)
    {
        $item = $this->employeeRepository->list($filter, $sort, $paginate);
        return $item;
    }
    
    public function listRoles($filter = false, $sort = false, $limit = false)
    {
        return $this->roleRepository->getAll($filter, $sort, $limit, ['*']);
    }

    // public function listAdminRole()
    // {
    //     return $this->roleUserRepository->getAdminRole();
    // }


    public function insert($data = [])
    {
        $data_user               = Arr::except($data, ['role', 'pwd']);
        $data_user['password']   = bcrypt($data['pwd']);
        $data_user['admin_id']   = get_data_user('admins', 'id');
        $data_user['active']     = AdminEnum::STATUS_ACTIVE;
        $data_user['created_at'] = now();
        $data_user['avatar']     = '';
        $user_id                 = $this->employeeRepository->insertGetId($data_user);
        $roles_req = $data['role'];
        if ($roles_req[0] == RoleEnum::SUPER_ADMIN) {
            $this->roleUserRepository->insert(
                ['admin_id' => $user_id, 'role_id' => 1, 'active' => AdminEnum::STATUS_ACTIVE, 'created_at' => now()]
            );
            $this->roleRepository->increaseNumberUser([RoleEnum::SUPER_ADMIN_ID]);
            $this->permissionRepository->increaseNumberUser([RoleEnum::SUPER_ADMIN_ID]);
        } else {
            $roles = $this->roleRepository->getAll(false, false, false, ['*']);
            $role_increase = array();
            $roles_user_insert   = array();
            foreach ($roles as $key => $value) {
                $index = in_array($value->name, $roles_req);
                if ($index) {
                    $role_user['admin_id'] = $user_id;
                    $role_user['role_id'] = $value->id;
                    $role_user['active'] = AdminEnum::STATUS_ACTIVE;
                    $role_user['created_at'] = now();
                    array_push($roles_user_insert, $role_user);
                    array_push($role_increase, $value->id);
                    // array_push($permission_increase, $value->id);

                    //  $this->roleUserRepository->insert([
                    //     ['admin_id' => $user_id, 'role_id' => $value->id, 'active' => 1, 'created_at' => now()],
                    // ]);
                    // $this->permissionRepository->increaseNumberUser($value->id);
                    // $this->roleRepository->increaseNumberUser($value->id);
                }
            }
            $this->roleUserRepository->roleUserInsert($user_id, $roles_user_insert);
            $this->roleRepository->increaseNumberUser($role_increase);
            $this->permissionRepository->increaseNumberUser($role_increase);
            // $this->roleUserRepository->roleUserInactive($user_id, $roles_user_inactive);
        }
        return $user_id;
    }

    public function findUser($id)
    {
        return $this->employeeRepository->findUser($id);
    }

    // public function getAdminRoleEdit($id)
    // {
    //     return $this->employeeRepository->getAdminRoleEdit($id); 
    // }

    public function update($id, $data)
    {
        $data_user = Arr::except($data, ['role']);
        $this->employeeRepository->update($id, $data_user);
        $this->updateRoleUser($id, $data['role']);
    }

    public function updateRoleUser($id, $roles_req)
    {
        $roles               = $this->roleRepository->getAll(false, false, false, ['*']);
        $roles_arr           = $roles->toArray();
        $filter              = [['admin_id', '=', $id]];
        $roles_user          = $this->roleUserRepository->list($filter);
        // $roles_user_arr = $roles_user->toArray();
        $roles_user_active   = array();
        $roles_user_inactive = array();
        $roles_user_insert   = array();

        // $roles_user_id = array_column($roles_user_arr, 'role_id');
        $check = 0;
        if ($roles_req[0] == RoleEnum::SUPER_ADMIN) {
            foreach ($roles_user as $role_user) {
                if (($role_user->role_id != RoleEnum::SUPER_ADMIN_ID) && ($role_user->active == 1)) {
                    array_push($roles_user_inactive, $role_user->role_id);
                } elseif ($role_user->role_id == RoleEnum::SUPER_ADMIN_ID) {
                    if($role_user->active == 0){
                        array_push($roles_user_active, $role_user->role_id);
                    }
                    $check = 1;
                }
            }
            if (!$check) {
                $this->roleUserRepository->roleUserInsert($id, [
                    ['admin_id' => $id, 'role_id' => 1, 'active' => AdminEnum::STATUS_ACTIVE, 'created_at' => now()]
                ]);
                $this->roleUserRepository->roleUserInactive($id, $roles_user_inactive);
                $this->roleRepository->increaseNumberUser([RoleEnum::SUPER_ADMIN_ID]);
                $this->permissionRepository->increaseNumberUser([RoleEnum::SUPER_ADMIN_ID]);
                $this->roleRepository->decreaseNumberUser($roles_user_inactive);
                $this->permissionRepository->decreaseNumberUser($roles_user_inactive);
            } else {
                // dd($roles_user_active);
                $this->roleUserRepository->roleUserActive($id, $roles_user_active);
                $this->roleRepository->increaseNumberUser($roles_user_active);
                $this->permissionRepository->increaseNumberUser($roles_user_active);

                $this->roleUserRepository->roleUserInactive($id, $roles_user_inactive);
                $this->roleRepository->decreaseNumberUser($roles_user_inactive);
                $this->permissionRepository->decreaseNumberUser($roles_user_inactive);
            }
            return;
        }
        $roles_id = [];
        // dump($roles_req);
        foreach ($roles_user as $key => $value) {
            $name = $value->permission->name;
            // dump($name);
            if (in_array($name, $roles_req)) {
                if($value->active == AdminEnum::STATUS_INACTIVE){
                    array_push($roles_user_active, $value->role_id);
                }
                array_splice($roles_req, array_search($name, $roles_req), 1);
            } else {
                if($value->active == AdminEnum::STATUS_ACTIVE){
                    array_push($roles_user_inactive, $value->role_id);
                }
                // array_splice($roles_req, array_search($name, $roles_req), 1);
            }
        }
        foreach ($roles_req as $role) {
            $num                            = array_search($role, array_column($roles_arr, 'name'));
            $role_user_insert['admin_id']   = $id;
            $role_user_insert['role_id']    = $num + 1;
            $role_user_insert['created_at'] = now();
            $role_user_insert['active']     = AdminEnum::STATUS_ACTIVE;
            array_push($roles_user_insert, $role_user_insert);
            array_push($roles_id, $num + 1);
        }

        $this->roleUserRepository->roleUserInsert($id, $roles_user_insert);
        $this->roleRepository->increaseNumberUser($roles_id);
        $this->permissionRepository->increaseNumberUser($roles_id);

        $this->roleUserRepository->roleUserActive($id, $roles_user_active);
        $this->roleRepository->increaseNumberUser($roles_user_active);
        $this->permissionRepository->increaseNumberUser($roles_user_active);

        $this->roleUserRepository->roleUserInactive($id, $roles_user_inactive);
        $this->roleRepository->decreaseNumberUser($roles_user_inactive);
        $this->permissionRepository->decreaseNumberUser($roles_user_inactive);
    }

}
