<?php

namespace Workable\Organization\Database\Seeders;

use Modules\Company\Database\Seeders\PermissionTableSeeder;

class OrganizationPermissionSeeder extends PermissionTableSeeder
{
    protected $path_config = 'plugins/organization/config/permission.php';

    public function run()
    {
        parent::run();
    }
}
