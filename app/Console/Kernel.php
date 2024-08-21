<?php

namespace App\Console;

use App\Services\InvoiceExpire;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('inspire')->hourly();

        /*$schedule->call(function () {
            (new InvoiceExpire())->handle();
        })->everyMinute();*/


       // $schedule->command('check-pending-payments')->everyTwoMinutes(); //Check Pending payments

        // $schedule->command('update:top-buyers')->everyTenMinutes();

        // $schedule->command('sites:update-statuses')->everyMinute();

        // $schedule->command('domain:check-propagation')->everyMinute();

        // $schedule->command('check-pending-payments')->everyFiveMinutes();

        // $schedule->command('create:ssl')->hourly();
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
