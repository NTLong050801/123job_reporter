<?php

namespace App\Console;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Modules\Monitor\Enum\MonitorEnum;
use Modules\Report\Entities\Monitor;
use App\Console\Commands\TestCommand;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        TestCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $this->__crawDataUploadPublic($schedule);
        $this->__crawDataSeoContent($schedule);
       // $this->__monitorDataSystem($schedule);
    }

    private function __crawDataUploadPublic(Schedule $schedule)
    {
        $schedule->command('worker-get-data:run uk --process=upload_public')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('worker-get-data:run us --process=upload_public')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('worker-get-data:run ca --process=upload_public')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('worker-get-data:run au --process=upload_public')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('worker-get-data:run fr --process=upload_public')->everyTenMinutes()->withoutOverlapping();
    }

    private function __crawDataSeoContent(Schedule $schedule)
    {
        $schedule->command('worker-get-data:run uk --process=seo_content')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('worker-get-data:run us --process=seo_content')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('worker-get-data:run ca --process=seo_content')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('worker-get-data:run au --process=seo_content')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('worker-get-data:run fr --process=seo_content')->everyTenMinutes()->withoutOverlapping();
    }

    private function __monitorDataSystem(Schedule $schedule)
    {
        $monitors = Monitor::where('uptime_check_enabled',MonitorEnum::STATUS_YES)->get();

        foreach ($monitors as $monitor) {
            $schedule->command('worker-get-data-monitor:run id='.$monitor->id)
                ->cron("0 */$monitor->uptime_check_interval_in_minutes * * *")->withoutOverlapping();
        }

    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }

}
