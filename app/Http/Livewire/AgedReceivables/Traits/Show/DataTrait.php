<?php

namespace App\Http\Livewire\AgedReceivables\Traits\Show;

use App\Models\FinancialPeriod as Period;
use App\Jobs\CreateCustomerAgedAccountReport as AgeReporting;
use App\Models\AgedAccount as Account;
use App\Models\Document;
use Carbon\Carbon;

trait DataTrait{

    public $documents, $start_date, $period_current, $period_30, $period_60, $period_90, $period_120, $period_over_120;

    public function loadData()
    {
        $this->start_date = $this->period->agedAccounts()
            ->orderBy('start_date', 'ASC')
            ->first()
            ->start_date;

        $this->documents = $this->period->documents()
            ->where('document_type_id', 115) // Receivables Ageing Report
            ->orderBy('created_at', 'DESC')
            ->get();

        $this->loadPeriods();
    }

    public function getDateRangeForBracket($duration_in_days)
    {
        $from = Carbon::parse($this->start_date)->subDays($duration_in_days);
        $to = $from->copy()->subDays(30);
        return $from->toDateString(). ' to '. $to->toDateString();
    }

    public function loadPeriods()
    {
        $this->period_current = $this->getDateRangeForBracket(0);
        $this->period_30 = $this->getDateRangeForBracket(30);
        $this->period_60 = $this->getDateRangeForBracket(60);
        $this->period_90 = $this->getDateRangeForBracket(90);
        $this->period_120 = $this->getDateRangeForBracket(120);
    }

    public function refreshAccount(Account $account)
    {
        try{
            $account->updateBalances();

            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Account refreshed successfully."
            ]);
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'error',
                'message'   =>  "An error occurred while refreshing the account: " . $e->getMessage()
            ]);
        }
    }

    public function generateAgedAccountReport()
    {
        $this->validate([
            'period' => 'required|exists:financial_periods,id',
        ]);

        try{

            $filter_array = [
                'financial_period_id' => $this->period->id
            ];

            dispatch(new AgeReporting($filter_array));

            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Your report will be generated in a couple of minutes. Please check the documents/reports tab."
            ]);
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('alert',[
                'type'      =>  'error',
                'message'   =>  "An error occurred while generating the report: " . $e->getMessage()
            ]);
        }
    }
}
