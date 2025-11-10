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
        
        // Auto-update CMS pages daily (runs at 2 AM)
        // Uncomment the line below to enable automatic daily updates
        // $schedule->command('cms:auto-update-pages')->dailyAt('02:00');
        
        // Or run every 6 hours
        // $schedule->command('cms:auto-update-pages')->everySixHours();
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
