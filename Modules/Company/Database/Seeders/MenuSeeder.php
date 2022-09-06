<?php

namespace Modules\Company\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = require_once (module_path('Company').'/Database/Files/menu.php');
        DB::table("menus")->truncate();

        foreach ($menu as $item)
        {
            $itemSelect = DB::table('menus')->where('menu_slug', $item['menu_slug'])->first();
            if (!$itemSelect)
            {
                DB::table('menus')->insert($item);
            }
            else
            {
                DB::table('menus')->where('id', $itemSelect->id)->update($item);
            }
        }
    }
}

