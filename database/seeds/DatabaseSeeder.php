<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $sqlAttribute = database_path('sample/attributes.sql');
        $sqlCareer    = database_path('sample/careers.sql');
        $sqlLocation  = database_path('sample/locations.sql');


        \Illuminate\Support\Facades\DB::unprepared(\Illuminate\Support\Facades\File::get($sqlAttribute));
        \Illuminate\Support\Facades\DB::unprepared(\Illuminate\Support\Facades\File::get($sqlCareer));
        \Illuminate\Support\Facades\DB::unprepared(\Illuminate\Support\Facades\File::get($sqlLocation));

        CliEcho::infonl('SQL Import Done');

    }
}