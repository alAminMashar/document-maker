<?php

namespace App\Http\Livewire\AgedReceivables\Traits\Show;

use App\Models\AgedAccount;
use App\Jobs\GenerateAgingAccountsReport;
use Auth;

trait FilterTrait{
   public $search = '';

    public function updateSearch(){
        $this->resetPage();
    }

    //filter variables
    public $filter_description, $result_count, $filter_balance_min, $filter_balance_max, $approved = true, $filter = false, $generate_report = false;

    protected $query;

    public function clearFilter(){
        $this->filter_balance_min       =   0;
        $this->filter_balance_max       =   0;
        $this->filter_description       =   '';
        $this->result_count             =   0;
        $this->query                    =   '';
        $this->approved                 =   true;
        $this->filter                   =   false;
    }

    public function updateFilter()
    {
        //Activate Filter
        $this->filter = true;
        $this->render();
    }

    public function filter()
    {
        $this->filter_description   =   "";
        $this->result_count         =   0;
        $min                        =   $this->filter_balance_min;
        $max                        =   $this->filter_balance_max;
        $approved                   =   $this->approved;

        $desc = "Showing filtered results for ";

        $query = AgedAccount::query()
        ->where('financial_period_id', $this->period->id)
        ->orderBy('balance_due','DESC')
        ->with('customer');

        if($this->search != '') {

            $query->whereHas('customer',function($q) {
                $q->where('name','like','%'.$this->search.'%')
                ->orWhere('kra_pin','like','%'.$this->search.'%')
                ->orWhere('code','like','%'.$this->search.'%')
                ->orWhere('id','like','%'.$this->search.'%');
            });
        }


        if($min != 0) {
            $query->where('current_balance','>=',$min);
            $desc   =   $desc." Ksh.".number_format($min,2)." minimum balance, ";
        }

        if($max != 0) {
            $query->where('current_balance','<=',$max);
            $desc   =   $desc." Ksh.".number_format($max,2)." maximum balance, ";
        }

        //Set Query
        $this->query = $query;
        //Write description
        $this->filter_description = $desc;
        //Result counter
        $this->result_count = $query->count();

        return $query;
    }

    public function generateReport()
    {
         try{

            $filter_array = [
                'search'         =>  $this->search,
                'balance_min'    =>  $this->filter_balance_min,
                'balance_max'    =>  $this->filter_balance_max,
                'period'         =>  $this->period,
            ];

            dispatch(new GenerateAgingAccountsReport($this->period, Auth::user(), $this->filter_description, $filter_array));

            $this->generate_report = false;

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
