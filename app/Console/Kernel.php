<?php

namespace App\Console;

use App\Console\Commands\ExpireOtpCommand;
use App\Console\Commands\SearchSimiliarDomain;
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

        $schedule->command(ExpireOtpCommand::class)->everyTwoMinutes();
        $schedule->command(SearchSimiliarDomain::class)->hourly();
        // $schedule->command(UpdateDomainDetails::class)->everyTenMinutes();
        $schedule->command('queue:work')->everyMinute();

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
