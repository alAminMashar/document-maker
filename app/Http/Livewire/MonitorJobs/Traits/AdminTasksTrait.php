<?php

namespace App\Http\Livewire\MonitorJobs\Traits;

use Illuminate\Support\Facades\Artisan;
use App\Jobs\RunMaintenance;

trait AdminTasksTrait{
    public function callRunMaintenance($task)
    {
        // check config environment only allow the approve all in dev or local
        if($task === "approveAllPending" && config('app.env') === 'production'){

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Ooops! We can't run this command in production."
            ]);

            return;
        }

        try {
            dispatch(new RunMaintenance($task));
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>   "Maintenance task successfully dispatched."
            ]);
        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Ooops! Something went wrong!"
            ]);
        }
    }

    public function optimizeBatch()
    {
        try {
            Artisan::call("optimize:batch");
            $output = Artisan::output();
            $this->loadFailedJobs(); // Refresh the table
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>   "All failed jobs in queue will be cleared. $output"
            ]);
        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Ooops! Something went wrong!"
            ]);
        }
    }
}
