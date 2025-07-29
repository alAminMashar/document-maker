<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\CustomerInvoice as Invoice;
use romanzipp\QueueMonitor\Traits\IsMonitored;
// use IsMonitored;



use App\Mail\MailInvoice;

use App\Mail\MailWithAttachment;
use Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    // use IsMonitored;

    protected $address, $invoice;

    public $timeout = 3300;

    /**
     * Create a new job instance.
     */
    public function __construct(Invoice $invoice, $address)
    {
        $this->address = $address;
        $this->invoice = $invoice;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $invoice = $this->invoice;
        $address = $this->address;

        //Generate PDF and Save to Files
        $invoice->saveAsDocument();

        //Select the documents
        foreach ($invoice->documents as $document) {
            $doc_path = $document->file_name;
        }

        $data = [
            'date'              =>  date('d M Y H:m:s'),
            'reference'         =>  $invoice->reference,
            'inv_name'          =>  $invoice->slug,
            'period'            =>  $invoice->period['slug'],
            'customer_name'     =>  $invoice->contract->customer['name'],
            'contact_person'    =>  $invoice->contract['contact_person'],
            'email'             =>  $address,
            'attachment'        =>  $doc_path,
            // 'attachment'        =>  public_path($doc_path),
        ];

        Mail::to($address)->send(new MailInvoice($data));

    }
}
