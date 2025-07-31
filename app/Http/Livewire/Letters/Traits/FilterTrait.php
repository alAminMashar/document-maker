<?php

namespace app\Http\Livewire\Letters\Traits;

use App\Models\Letter;

trait FilterTrait{

    public $search = '';

    public function updateSearch(){
        $this->resetPage();
    }

    protected $paginationTheme = 'bootstrap';

    //filter variables
    protected $query;

    public $filter_description, $result_count, $filter = false, $filter_published = false;

    //Custom fields
    public $from, $to;


    public function clearFilter(){
        $this->filter                   =   false;
        $this->filter_published         =   false;
        $this->query                    =   '';
        $this->result_count             =   0;
        $this->filter_description       =   '';
        $this->from                     =   '';
        $this->to                       =   '';
    }

    public function updateFilter()
    {
        //Activate Filter
        $this->filter = true;
        $this->render();
    }

    public function filter()
    {
        $this->filter_description    =   "";
        $this->result_count          =   0;
        $published                   =   $this->filter_published;
        $from                        =   $this->from;
        $to                          =   $this->to;
        $search                      =   $this->search;

        $desc = "Showing filtered results for ";

        $query = Letter::query()->orderBy('created_at', 'DESC');

        if($search != ''){
            $query->where('serial_number','like','%'.$search.'%')
            ->orWhere('title','like','%'.$search.'%')
            ->orWhere('content','like','%'.$search.'%');
        }

        if($from != '') {
            $query->where('created_at','>=',$from);
            $desc   =   $desc." created from ".$from.", ";
        }

        if($to != '') {
            $query->where('created_at','<=',$to);
            $desc   =   $desc." created to ".$to.", ";
        }

        if($published != false){
            $query->where('published',$published);
            $published_description = $published?" published.":" unpublished.";
            $desc   =   $desc.$published_description;
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
