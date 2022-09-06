<?php
namespace Workable\ReferenceSite\Database\Seeders;
use Modules\Company\Database\Seeders\PermissionTableSeeder;

class ReferenceSitePermission extends PermissionTableSeeder
{
    protected $path_config = 'plugins/reference-site/config/permission.php';
    public function run()
    {
        parent::run();
    }
}
