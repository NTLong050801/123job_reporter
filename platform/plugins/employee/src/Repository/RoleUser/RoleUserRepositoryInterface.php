<?php
namespace Workable\Employee\Repository\RoleUser;

interface RoleUserRepositoryInterface
{
    public function list($filter=false, $sort=false, $paginate=false);

    // public function updateRoleUser($id, $roles_user_inactive, $roles_user_active, $roles_user_insert);

    public function roleUserActive($id, $roles_user_active);

    public function roleUserInactive($id, $roles_user_inactive);

    public function roleUserInsert($id, $roles_user_insert);
    // public function getAdminRole();
}
