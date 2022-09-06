<?php

namespace Workable\Organization\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanySeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = require_once(plugin_path('organization') . '/src/Database/Files/company.php');
        foreach ($items as $item) {
            $data = $item;
            $item = $this->findOne($item['name']);
            if (!$item)
            {
                $this->store($data);
            }
        }
    }

    private function findOne($name)
    {
        $slug = Str::slug($name);
        return DB::table('companies')->where('slug', $slug)->first();
    }

    private function getParentId($data)
    {
        $parentId = $data['parent_id'] ?? -1;
        if ($parentId != -1) return 0;

        $key = $data['key'];
        $item = $this->findOne($key);
        return $item->id;
    }

    private function store($data = [])
    {
        $data['slug']      = Str::slug($data['name']);
        $data['parent_id'] = $this->getParentId($data);
        $data['created_at'] = now();
        $data['updated_at'] = now();


        unset($data['key']);
        return DB::table('companies')->insert($data);
    }
}
