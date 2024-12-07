<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('process:number-validation')->everyMinute()->withoutOverlapping();
        $schedule->command('send:bulk-messages')->everyMinute()->withoutOverlapping();
        $schedule->command('get:bulk-message-status')->everyMinute()->withoutOverlapping();
        $schedule->command('send:event-messages')->everyMinute()->withoutOverlapping();
        $schedule->command('send:number-renewal-alert')->dailyAt('23:59')->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
