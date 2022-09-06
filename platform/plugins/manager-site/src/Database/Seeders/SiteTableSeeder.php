<?php

namespace Workable\ManagerSite\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteTableSeeder extends Seeder
{
    public function run()
    {
        $dataExample = $this->buildData();

        foreach($dataExample as $value){
            DB::table('sites')->insert($value);
        }

    }


    private function buildData(): array
    {
        return [
            [
                "name" => '123job',
                "description" => "website tim viec lam va viet Cv",
                "active" => 1,
                "status" => 1,
            ],
            [
                "name" => '123work',
                "description" => "website tim viec lam va viet Cv",
                "active" => 1,
                "status" => 1,
            ],
            [
                "name" => 'vatgia',
                "description" => "trang thuong mai dien tu",
                "active" => 1,
                "status" => 1,
            ],
            [
                "name" => '1hz',
                "description" => "trang tin dang bat dong san",
                "active" => 1,
                "status" => 1,
            ],
        ];
    }
}

// php artisan db:seed --class=\\Workable\\ManagerSite\\Database\\Seeders\\SiteSeeder
