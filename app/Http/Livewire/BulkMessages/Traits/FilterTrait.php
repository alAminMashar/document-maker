<?php

namespace App\Http\Livewire\BulkMessages\Traits;
use Livewire\WithPagination;

trait FilterTrait{

    use WithPagination;

    public $search = '';

    public function updateSearch(){
        $this->resetPage();
    }

    protected $paginationTheme = 'bootstrap';

    //filter variables
    // public $filter_description, $result_count, $filter_balance_min, $filter_balance_max, $filter_type, $filter_status, $approved = true, $filter = false;

    protected $query;

    public function clearFilter(){
        // $this->filter_balance_min       =   0;
        // $this->filter_balance_max       =   0;
        // $this->filter_type              =   '';
        // $this->filter_status            =   '';
        // $this->filter_description       =   '';
        // $this->result_count             =   0;
        // $this->query                    =   '';
        // $this->approved                 =   true;
        // $this->filter                   =   false;
    }

    public function updateFilter()
    {
        //Activate Filter
        $this->filter = true;
        $this->render();

    }

    public function filter()
    {

        // $this->filter_description   =   "";
        // $this->result_count         =   0;
        // $min                        =   $this->filter_balance_min;
        // $max                        =   $this->filter_balance_max;
        // $status                     =   $this->filter_status;
        // $type                       =   $this->filter_type;
        // $approved                   =   $this->approved;

        // $desc = "Showing filtered results for ";

        // $query = Customers::query();

        // $query->where('name','like','%'.$this->search.'%')
        // ->orWhere('code','like','%'.$this->search.'%')
        // ->orWhere('id','like','%'.$this->search.'%');

        // if($min != 0) {
        //     $query->where('current_balance','>=',$min);
        //     $desc   =   $desc." Ksh.".number_format($min,2)." minimum balance, ";
        // }

        // // $query->where('published',$approved);
        // // $approval_description = $approved?"approved.":"pending approval.";
        // // $desc   =   $desc.$approval_description;

        // //Set Query
        // $this->query = $query;
        // //Write description
        // $this->filter_description = $desc;
        // //Result counter
        // $this->result_count = $query->count();

        // return $query;

    }

}
