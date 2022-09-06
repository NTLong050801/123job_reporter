<?php

namespace Modules\Company\Database\Seeders;

class CompanyPermissionSeeder extends PermissionTableSeeder
{
    protected $moduleConfig;

    public function run()
    {
        $this->moduleConfig = module_path("Company") . '/Config/permission.php';
        parent::run();
    }
}
