<?php
namespace Workable\Employee\Repository\Employee;

interface EmployeeRepositoryInterface {

    public function list($filter=false, $sort = false, $paginate = 10);

    public function findUser($id);

    // public function getAdminRoleEdit($id);

    // public function updateAdminRole($id, $role_delete, $role_exist, $role_insert);

}
