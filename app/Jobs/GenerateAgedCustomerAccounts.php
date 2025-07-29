<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Jobs\CreateCustomerAgedAccount;

use App\Models\Customer;
use App\Models\AgedAccount;
use App\Models\MonthlyBill as Bill;
use Auth;

class GenerateAgedCustomerAccounts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $filter_array, $financial_period_id, $bill, $start_date;

    /**
     * Create a new job instance.
     */
    public function __construct($filter_array)
    {
        $this->filter_array = $filter_array;
        $this->financial_period_id = $filter_array['financial_period_id'];
        $this->bill = $this->findMatchingBill();
        $this->start_date = $this->bill['month_end'];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->runCustomerAgedAccounts();
    }

    public function findMatchingBill()
    {
        $bill = Bill::where('financial_period_id','=',$this->financial_period_id)->first();
        if(!$bill){
            $bill =  Bill::orderBy('created_at','DESC')->first();
        }
        return $bill;
    }

    public function runCustomerAgedAccounts()
    {
        foreach(Customer::get() as $customer)
        {
            dispatch(new CreateCustomerAgedAccount($this->initiateAccount($customer)));
        }
    }

    public function initiateAccount(Customer $customer)
    {
        $unique = AgedAccount::where('customer_id', $customer->id)
        ->where('financial_period_id', $this->bill['financial_period_id'])
        ->first();

        if($unique){
            return $unique;
        }
        return AgedAccount::create([
            'start_date'            => $this->start_date,
            'customer_id'           => $customer->id,
            'financial_period_id'   => $this->bill['financial_period_id'],
        ]);
    }

}
