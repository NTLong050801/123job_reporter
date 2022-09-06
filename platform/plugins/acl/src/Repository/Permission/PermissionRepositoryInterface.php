<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 3/2/19
 * Time: 17:34
 */

namespace Workable\Acl\Repository\Permission;


interface PermissionRepositoryInterface
{
    public function list($filter= false, $sort= false, $limit=false);

    public function getList($params = []);

    public function getListAll($param = [], $field = ['*'], $paginate = false);

    public function insertData($data = []);

    public function updateHasChild($id);

    public function disableAllChild($column, $value, $data=[]);

    public function getPermissionByUser($filter=false, $sort = false);

    public function getPermissionByRole($filter=false, $sort = false);

    public function getRolePermission($id);

    public function getUserPermission($id);

    public function getUserPermission2($id);

    public function updateRole($permission, $role);

    public function updateUser($permission, $user);

    public function increaseNumberUser($roles_id=[], $permissions_id=[]);

    public function decreaseNumberUser($roles_id=[], $permissions_id=[]);
}
