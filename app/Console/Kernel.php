<?php

namespace App\Console;

use App\Console\Commands\ExpiredItems;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use App\Console\Commands\MonthlyEmailSchedule;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('expired:items')->everyMinute();
           $schedule->command('send:daily-heartbeat-email')->everyMinute(2);
        // $schedule->command('reset:md')->monthlyOn(1, '1:00');
           $schedule->command('email:monthly-schedule')->everyMinute(2);
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        // require base_path('routes/console.php');
    }
    protected $commands = [
        MonthlyEmailSchedule::class,
        ExpiredItems::class,
    ];
}
