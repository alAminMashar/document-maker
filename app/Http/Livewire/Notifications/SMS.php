<?php

namespace App\Http\Livewire\Notifications;
use App\Jobs\SendSMS;

class SMS{

    public static function send($phone_number, $message)
    {
        dispatch_sync(new SendSMS($phone_number, $message));
    }

}
