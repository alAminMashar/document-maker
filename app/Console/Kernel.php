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
        // /usr/local/bin/ea-php82 /home/shieldm1/demo-app/artisan schedule:run
        $schedule->command('queue:work --timeout=3600 --stop-when-empty')
        ->everyFiveMinutes()
        ->withoutOverlapping();

        $schedule->job(new AddLocationToPatrolRecords)
        ->everyMinute();

        // Clean Location Data
        $schedule->job(new CleanLocationData)
        ->dailyAt('22:30');

        //Balance System Ledgers
        $schedule->job(new UpdateAllEmployees)
        ->dailyAt('23:00');

        //Balance System Ledgers
        $schedule->job(new BalanceLedgers)
        ->dailyAt('23:30');

        //Balance System Ledgers
        $schedule->job(new RunReport())
        ->dailyAt('20:50');

        // $schedule->command('app:backup-database')
        // ->dailyAt('23:30');

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
