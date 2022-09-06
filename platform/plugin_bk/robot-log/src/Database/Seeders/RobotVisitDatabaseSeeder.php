<?php

namespace Workable\RobotLog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Workable\Base\Supports\CliEcho;
use Workable\RobotLog\Enum\RobotVisitEnum;

class RobotVisitDatabaseSeeder extends Seeder
{

    private $date;

    public function run()
    {
        DB::table('robot_visits')->truncate();

        $baseData = [
            'app_int'    => RobotVisitEnum::APP_123JOB,
            'app_text'   => RobotVisitEnum::APP[RobotVisitEnum::APP_123JOB],
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $listBot = config('plugins.robot-log.robot_counter.list_bot');

        for ($i = 60; $i >= 0; $i--)
        {
            $this->date = now()->subDays($i)->toDateString();
            CliEcho::infonl("- Fake robot visit for date: " . $this->date);

            foreach (config('plugins.google-log.config.page') as $label => $paths)
            {
                CliEcho::infonl("  -- Process for label page: " . $label);
                foreach ($paths as $path)
                {
                    $this->__processPath($path, $label, $listBot, $baseData);
                }
            }
        }
    }

    private function __processPath($path, $label, $listBot, $baseData)
    {
        CliEcho::infonl("   --- Process for path: " . $path);

        $dataSave   = [];

        $data = array_merge($baseData, [
            'path'       => $path,
            'label_page' => $label
        ]);

        foreach ($listBot as $bot)
        {
            $data['bot'] = $bot;
            $numberFake = rand(50, 100);
            for($i = 1; $i <= $numberFake; $i++)
            {
                $dataVisit   = $this->__makeDataVisit($path);
                $data        = array_merge($data, $dataVisit);
                $dataSave[]  = $data;
            }
        }

        DB::table('robot_visits')->insert($dataSave);
    }

    private function __makeDataVisit($path)
    {
        return [
            'execute_time' => rand(100, 200),
            'url_visit'    => $path . str_random(),
            'visited_at'   => $this->date .' ' .rand(0, 23) . ':' . rand(0, 59) . ':' . rand(0, 59),
            'ip_address'   => '118.70.' . rand(10, 100) . '.' . rand(10, 999),
        ];

    }
}
