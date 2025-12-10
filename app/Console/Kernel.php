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
        // $schedule->job(new \App\Jobs\ScraperBCV)->hourly();
        $schedule->command('preorders:purge')
            ->dailyAt('02:30')
            ->withoutOverlapping();

        // Procesa automáticamente las pre-órdenes aprobadas (R4)
        // para generar las órdenes correspondientes.
        $schedule->command('preorders:process-auto --limit=75')
            ->everyMinute()
            ->withoutOverlapping();
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
