<?php

namespace Workable\Attribute\Database\Seeders;

use Modules\Company\Database\Seeders\PermissionTableSeeder;

class AttributePermissionSeeder extends PermissionTableSeeder
{
    protected $path_config = 'plugins/attribute/config/permission.php';

    public function run()
    {
        parent::run();
    }
}
