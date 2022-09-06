<?php

namespace Workable\Acl\Database\Seeders;

use Illuminate\Support\Facades\DB;
use Modules\Company\Database\Seeders\PermissionTableSeeder;

class AclPermissionSeeder extends PermissionTableSeeder
{
    protected $path_config = 'plugins/acl/config/permission.php';

    public function run()
    {
        parent::run();
    }
}
