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


use App\Models\User;

use App\Notifications\SystemNotifications;

class SystemUpdates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    // use IsMonitored;

    protected $type, $message;

    public $timeout = 3300;

    /**
     * Create a new job instance.
     */
    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $type       =   $this->type;
        $message    =   $this->message;

        //Filter permission for this notification
        $users  = User::all();
        foreach($users as $user)
        {
            if($type == 'invoices'){

                if($user->canany(['receive-invoices-run-notifications.index']))
                {$user->notify(new SystemNotifications($message));}

            }elseif($type == 'payroll'){

                if($user->canany(['receive-payroll-run-notifications.index']))
                {$user->notify(new SystemNotifications($message));}

            }elseif($type == 'feedback'){

                if($user->canany(['customer-feedback.index']))
                {$user->notify(new SystemNotifications($message));}

            }elseif($type == 'sensitive'){

                if($user->canany(['view-outstanding-balance']))
                {$user->notify(new SystemNotifications($message));}

            }
        }

        notify()->success($message, $type);

    }

    // $type = 'invoices';
    // $task = new SystemUpdates($type);
    // dispatch($task);

}
