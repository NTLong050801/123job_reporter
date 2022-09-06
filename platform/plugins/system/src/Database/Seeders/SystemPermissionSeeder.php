<?php

namespace Workable\System\Database\Seeders;

use Modules\Company\Database\Seeders\PermissionTableSeeder;

class SystemPermissionSeeder extends PermissionTableSeeder
{
    protected $path_config = 'plugins/system/config/permission.php';

    public function run()
    {
        parent::run();
    }
}