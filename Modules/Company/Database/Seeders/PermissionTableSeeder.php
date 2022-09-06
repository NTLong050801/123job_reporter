<?php

namespace Modules\Company\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    protected $table = 'admin_permissions';

    public function run()
    {
        if(property_exists($this, 'moduleConfig'))
        {
            $items = require($this->moduleConfig);
        }else if (property_exists($this, 'path_config'))
        {
            $items = require(platform_path($this->path_config));
        }

        foreach ($items as $key => $listItem) {
                $menu = DB::table('menus')->where('menu_slug', $key)->first(['id']);

                if ($menu) {
                    foreach ($listItem as $item)
                    {
                        \CliEcho::infonl('-- Run permission:'. print_r($item['menu'], true));

                        $data = $item;
                        $data['menu_id'] = $menu->id;
                        unset($data['menu']);

                        try
                        {
                            $id = $this->insertGetId($data);
                            $menus = $item['menu'] ?? [];
                            $this->insertSubMenu($menus, $id, $menu->id);
                            $this->updateHasChild($id, $menus);
                        }
                        catch (\Exception $e)
                        {
                            dump($e->getMessage());
                        }
                    }
                }
            }
    }

    private function updateHasChild($id, $menus)
    {
        if ($menus) {
            DB::table($this->table)->where('id', $id)->update([
                'has_child' => 1
            ]);
        }
    }

    private function insertSubMenu($datas = [], $parent_id = 0,  $menu_id = 0)
    {
        foreach ($datas as $data) {
            $data['menu_id'] = $menu_id;
            $data['parent_id'] = $parent_id;
            $this->insertGetId($data);
        }
    }

    private function insertGetId($data)
    {
        $data['created_at'] = now();
        $data['updated_at'] = now();

        if ($item = $this->findOne($data['uri'])) {
            DB::table($this->table)->where('uri', $data['uri'])->update($data);
            return $item->id;
        }

        DB::table('menus')->where('id', $data['menu_id'])->increment('menu_menu_hit');

        return DB::table($this->table)->insertGetId($data);
    }

    private function findOne($uri)
    {
        return DB::table($this->table)->where('uri', $uri)->first(['id']);
    }
}
