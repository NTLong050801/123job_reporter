<?php

namespace Workable\GoogleLog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Workable\Base\Supports\CliEcho;
use Workable\GoogleLog\Enum\GoogleLogEnum;

class GoogleLogSeeder extends Seeder
{

    public function run()
    {
        DB::table('google_logs')->truncate();

        $data = [
            'app_int'    => GoogleLogEnum::APP_123JOB,
            'app_text'   => GoogleLogEnum::APP[GoogleLogEnum::APP_123JOB],
            'created_at' => now(),
            'updated_at' => now(),
        ];

        for ($i = 200; $i >= 0; $i--)
        {
            foreach (config('plugins.google-log.config.page') as $label => $paths)
            {
                foreach ($paths as $path)
                {
                    $dataSave = [];
                    $day      = now()->subDays($i)->toDateString();
                    CliEcho::infonl("-- Fake google log date: " . $day);
                    $data['source_created_at'] = $day;
                    $data['path']              = $path;
                    $data['label_page']        = $label;

                    $dataSave[] = $this->__makeDataUser($data);
                    $dataSave[] = $this->__makeDataSession($data);
                    $dataSave[] = $this->__makeDataPageView($data);
                    $dataSave[] = $this->__makeDataBounceRate($data);

                    DB::table('google_logs')->insert($dataSave);
                }
            }
        }
    }

    private function __makeDataUser($data)
    {
        return array_merge($data, [
            'log_int'  => GoogleLogEnum::LOG_USER,
            'log_text' => GoogleLogEnum::LOG[GoogleLogEnum::LOG_USER],
            'hit'      => rand(3000, 4000),
        ]);
    }

    private function __makeDataSession($data)
    {
        return array_merge($data, [
            'log_int'  => GoogleLogEnum::LOG_SESSION,
            'log_text' => GoogleLogEnum::LOG[GoogleLogEnum::LOG_SESSION],
            'hit'      => rand(4000, 5000),
        ]);
    }

    private function __makeDataPageView($data)
    {
        return array_merge($data, [
            'log_int'  => GoogleLogEnum::LOG_PAGE_VIEW,
            'log_text' => GoogleLogEnum::LOG[GoogleLogEnum::LOG_PAGE_VIEW],
            'hit'      => rand(15000, 20000),
        ]);
    }

    private function __makeDataBounceRate($data)
    {
        return array_merge($data, [
            'log_int'  => GoogleLogEnum::LOG_BOUNCE_RATE,
            'log_text' => GoogleLogEnum::LOG[GoogleLogEnum::LOG_BOUNCE_RATE],
            'hit'      => rand(70, 80),
        ]);
    }
}
