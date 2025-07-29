<?php

namespace App\Http\Livewire\AgedReceivables\Traits;

use App\Models\FinancialPeriod as Period;

trait FilterTrait{
   public $search = '';

    public function updateSearch(){
        $this->resetPage();
    }

    //filter variables
    public $filter_description, $result_count, $filter = false, $generate_report = false;

    protected $query;

    public function clearFilter(){
        $this->filter_description       =   '';
        $this->result_count             =   0;
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

        $desc = "Showing filtered results for ";

        $query = Period::query()
            ->whereHas('agedAccounts')
            ->orderBy('year','DESC')
            ->orderBy('created_at','DESC')
            ->withCount('agedAccounts');

        if($this->search != '') {
            $query->where(function($q) {
                $q->where('year','like','%'.$this->search.'%')
                  ->orWhere('slug','like','%'.$this->search.'%')
                  ->orWhere('month','like','%'.$this->search.'%');
            });
        }

        //Set Query
        $this->query = $query;
        //Write description
        $this->filter_description = $desc;
        //Result counter
        $this->result_count = $query->count();

        return $query;

    }
}
