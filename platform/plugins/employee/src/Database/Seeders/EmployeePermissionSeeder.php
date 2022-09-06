<?php

namespace Workable\Employee\Database\Seeders;

use Modules\Company\Database\Seeders\PermissionTableSeeder;

class EmployeePermissionSeeder extends PermissionTableSeeder
{
    protected $path_config = 'plugins/employee/config/permission.php';

    public function run()
    {
        parent::run();
    }
}
