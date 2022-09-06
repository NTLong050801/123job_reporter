<?php

namespace Modules\Company\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionTableSeeder extends Seeder
{
    protected $table = 'admin_role_permission';

    public function run()
    {
        if (property_exists($this, 'moduleConfig')) {
            $role_permissions = require($this->moduleConfig);
        } else if (property_exists($this, 'path_config')) {
            $role_permissions = require(platform_path($this->path_config));
        }

        $insert         = [];
        $roles          = require(platform_path('plugins/acl/src/Database/Files/role.php'));

        $roles_arr      = array_column($roles, 'name');
        $permissions_db = DB::table('admin_permissions')->select('id', 'name', 'uri', 'parent_id')->get();

        $permissions_uri       = $permissions_db->pluck('uri')->toArray();
        $permissions_route     = $permissions_db->pluck('name')->toArray();
        $permissions_parent_id = $permissions_db->pluck('parent_id')->toArray();

        foreach ($role_permissions as $role => $permissions) {
            $role_id = array_search($role, $roles_arr) + 1;
            foreach ($permissions as $permission) {
                if ($permission[0] == '/') {
                    $permission_id = array_search($permission, $permissions_uri);
                } else {
                    $permission_id = array_search($permission, $permissions_route);
                    // dd($permission_id);
                }
                if ($permission_id) {
                    if ($permissions_parent_id[$permission_id] != 0) {
                        array_push($insert, [
                            'role_id'       => $role_id,
                            'permission_id' => $permissions_parent_id[$permission_id],
                            'active'        => 1,
                            'created_at'    => now()
                        ]);
                    }
                    array_push($insert, [
                        'role_id'       => $role_id,
                        'permission_id' => $permission_id + 1,
                        'active'        => 1,
                        'created_at'    => now()
                    ]);
                }
            }
        }
        DB:: table($this->table)->insertOrIgnore($insert);
    }
}
