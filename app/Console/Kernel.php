<?php

namespace App\Console;

use App\Jobs\BalanceLedgers;
use App\Jobs\RunRecurrentPayrollTasks;
use App\Jobs\AddLocationToPatrolRecords;
use App\Jobs\CleanLocationData;
use App\Jobs\UpdateAllEmployees;
use App\Jobs\GenerateCustomerMonthlyReport as RunReport;


use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{

    protected $commands = [
        \App\Console\Commands\OptimizeBatch::class,
        \App\Console\Commands\BackUpDatabase::class,
    ];

    /**
 * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        //Cron Job Here
        $schedule->command('queue:work --queue=default,schedules,sessions --timeout=3600 --stop-when-empty')
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
