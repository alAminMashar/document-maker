<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use AfricasTalking\SDK\AfricasTalking;

class SendSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $recipient, $message;

    /**
     * Create a new job instance.
     */
    public function __construct($recipient, $message)
    {
        $this->message = $message;
        $this->recipient = $this->cleanPhone($recipient);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $username   = config('afristalking.username');
        $apiKey     = config('afristalking.key');
        $senderId   = config('afristalking.senderId');

        $AT       = new AfricasTalking($username, $apiKey);
        $sms      = $AT->sms();


        try {

            $result = $sms->send([
                'to'      => $this->recipient,
                'message' => $this->message,
                'from'    => $senderId // Sender ID (once approved)
            ]);

            Log::info('SMS:', $result);

        } catch (\Exception $ex) {
            Log::error('SMS Error:', $ex);
        }
    }

    private function cleanPhone($phone_number)
    {
        if ($phone_number != '') {
            $phone_number = "+254". substr($phone_number, -9);
        }

        return $phone_number;
    }

}

