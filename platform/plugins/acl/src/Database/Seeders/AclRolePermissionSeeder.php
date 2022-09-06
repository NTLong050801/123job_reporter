<?php

namespace Workable\Acl\Database\Seeders;

use Modules\Company\Database\Seeders\RolePermissionTableSeeder;

class AclRolePermissionSeeder extends RolePermissionTableSeeder
{
    protected $path_config = 'plugins/acl/config/role_permissions.php';

    public function run()
    {
        parent::run();
    }
}
