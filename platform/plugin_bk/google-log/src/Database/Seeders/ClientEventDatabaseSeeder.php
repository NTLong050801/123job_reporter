<?php
namespace Workable\GoogleLog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Workable\Base\Supports\CliEcho;
use Workable\GoogleLog\Enum\ClientEventEnum;

class ClientEventDatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('client_events')->truncate();

        $data = [
            'app_int'           => ClientEventEnum::APP_123JOB,
            'app_text'          => ClientEventEnum::APP[ClientEventEnum::APP_123JOB],
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        for($i = 200; $i >= 0; $i--)
        {
            foreach (config('plugins.google-log.config.page') as $label => $paths)
            {
                foreach ($paths as $path)
                {
                    $dataSave = [];
                    $day      = now()->subDays($i)->toDateString();
                    CliEcho::infonl("-- Fake client event date: " . $day);
                    $data['source_created_at'] = $day;
                    $data['path']              = $path;
                    $data['label_page']        = $label;

                    $dataSave[] = $this->__makeDataClickSubscribeJob($data);
                    $dataSave[] = $this->__makeDataOpenSubscribeJob($data);
                    $dataSave[] = $this->__makeDataClickApplyJob($data);

                    DB::table('client_events')->insert($dataSave);
                }
            }
        }
    }

    private function __makeDataClickSubscribeJob($data)
    {
        return array_merge($data, [
            'event_int'  => ClientEventEnum::EVENT_CLICK_SUBSCRIBE_JOB,
            'event_text' => ClientEventEnum::EVENT[ClientEventEnum::EVENT_CLICK_SUBSCRIBE_JOB],
            'provider'   => 'google-analyst',
            'hit'        => rand(100, 1000),
        ]);
    }

    private function __makeDataOpenSubscribeJob($data)
    {
        return array_merge($data, [
            'event_int'  => ClientEventEnum::EVENT_OPEN_SUBSCRIBE_JOB,
            'event_text' => ClientEventEnum::EVENT[ClientEventEnum::EVENT_OPEN_SUBSCRIBE_JOB],
            'provider'   => '123job',
            'hit'        => rand(100, 1000),
        ]);
    }

    private function __makeDataClickApplyJob($data)
    {
        return array_merge($data, [
            'event_int'  => ClientEventEnum::EVENT_CLICK_OPEN_APPLY,
            'event_text' => ClientEventEnum::EVENT[ClientEventEnum::EVENT_CLICK_OPEN_APPLY],
            'provider'   => 'google-analyst',
            'hit'        => rand(100, 1000),
        ]);
    }
}
