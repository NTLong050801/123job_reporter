<?php

namespace Workable\RobotLog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Workable\Base\Supports\CliEcho;
use Workable\RobotLog\Enum\RobotCounterEnum;

class RobotCounterDatabaseSeeder extends Seeder
{

    public function run()
    {
        DB::table('robot_counters')->truncate();

        $data = [
            'app_int'    => RobotCounterEnum::APP_123JOB,
            'app_text'   => RobotCounterEnum::APP[RobotCounterEnum::APP_123JOB],
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
                    CliEcho::infonl("-- Fake robot counter for date: " . $day);
                    $data['date']       = $day;
                    $data['path']       = $path;
                    $data['label_page'] = $label;

                    $dataSave[] = $this->__makeDataGoogleBot($data);
                    $dataSave[] = $this->__makeDataBingBot($data);
                    $dataSave[] = $this->__makeDataYahooBot($data);

                    DB::table('robot_counters')->insert($dataSave);
                }
            }
        }
    }

    private function __makeDataGoogleBot($data)
    {
        $data['bot'] = 'googlebot';
        $dataVisit   = $this->__makeDataVisit();

        return array_merge($data, $dataVisit);
    }

    private function __makeDataBingBot($data)
    {
        $data['bot'] = 'bingbot';
        $dataVisit   = $this->__makeDataVisit();

        return array_merge($data, $dataVisit);
    }

    private function __makeDataYahooBot($data)
    {
        $data['bot'] = 'slurp';
        $dataVisit   = $this->__makeDataVisit();

        return array_merge($data, $dataVisit);
    }

    private function __makeDataVisit()
    {
        $totalVisit = rand(1, 10);
        $avgTime    = rand(100, 1000);
        $totalTime  = $totalVisit * $avgTime;
        $maxTime    = $avgTime + rand(10, 100);
        $minTime    = $avgTime - rand(10, 100);

        $byHour = [];
        $hour   = rand(0, 23);
        for ($i = 0; $i <= 23; $i++)
        {
            if ($i == $hour)
            {
                $byHour[$i]['total_visit'] = $totalVisit;
                $byHour[$i]['total_time']  = $totalTime;
            }
            else
            {
                $byHour[$i]['total_visit']      = 0;
                $byHour[$i]['total_time'] = 0;
            }
        }

        return [
            'total_visit'      => $totalVisit,
            'total_time'       => $totalTime,
            'min_execute_time' => $minTime,
            'max_execute_time' => $maxTime,
            'avg_execute_time' => $avgTime,
            'by_hour'          => json_encode($byHour),
        ];

    }
}
