<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use romanzipp\QueueMonitor\Traits\IsMonitored;
// use IsMonitored;

use Illuminate\Support\Str;
use Auth;

class RunMaintenance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 3300;

    public $task;
    /**
     * Create a new task instance.
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        switch ($this->task) {
            case "approveAllPending":
                break;

            case "updateEmployeeDetails":
                break;
            case "runCustomerMonthlyReport":
                    break;
            default:
                break;
        }
    }

    private function runCustomerMonthlyReport()
    {
        return true;
    }

}
