<?php

namespace Workable\Acl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = require(platform_path('plugins/acl/src/Database/Files/role.php'));
        DB::table('admin_roles')->truncate();
        foreach ($roles as $role)
        {
            $slug = Str::slug($role['title']);
            $roleSelect = DB::table('admin_roles')
                ->where('slug', $slug)
                ->orWhere('name', $role['name'])
                ->first();
            if (!$roleSelect)
            {
                $role['slug'] = $slug;
                $role['number_user']=0;
                DB::table('admin_roles')->insert($role);
            }
        }

        DB::table('admin_roles')->where('id', 1)->update(['number_user'=>1]);
    }
}
