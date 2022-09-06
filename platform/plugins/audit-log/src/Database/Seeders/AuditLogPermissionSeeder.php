<?php

namespace Workable\AuditLog\Database\Seeders;

use Modules\Company\Database\Seeders\PermissionTableSeeder;

class AuditLogPermissionSeeder extends PermissionTableSeeder
{
    protected $path_config = 'plugins/audit-log/config/permission.php';

    public function run()
    {
        parent::run();
    }
}
