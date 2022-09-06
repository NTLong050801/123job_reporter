<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 3/2/19
 * Time: 18:02
 */

namespace Workable\Acl\Repository\Role;


interface RoleRepositoryInterface
{
    public function getList($filter, $field=['*'], $paginate=10);

    public function getListSlug();

    public function destroy($id);

    public function createRole($dataInsert);

    public function getUser($id);

    public function getPermission($id);

    public function roleAdminUpdate($role, $user);

    public function increaseNumberUser($id_arr);

    public function decreaseNumberUser($id_arr);
}
