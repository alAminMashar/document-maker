<?php

namespace App\Http\Livewire\Voters\Traits;
use App\Models\Voter;
use App\Jobs\GenerateVoterReport;
use App\Models\Poll;
use Auth;

trait FilterTrait
{

    //filter variables
    public  $filter_description, $result_count, $filter_poll_id, $filter_created_from, $filter_created_to, $generate_report = false, $filter = false, $filter_active = true;

    protected $query;

    public function clearFilter(){
        $this->query                =   '';
        $this->filter_description   =   '';
        $this->result_count         =   0;
        $this->active               =   true;
        $this->filter               =   false;
        $this->generate_report      =   false;
        $this->filter_created_from  =   '';
        $this->filter_created_to    =   '';
        $this->filter_poll_id       =   '';
    }

    public function updateFilter()
    {
        //Activate Filter
        $this->filter = true;
        $this->render();
    }

    public function filter()
    {
        $created_from               =   $this->filter_created_from;
        $created_to                 =   $this->filter_created_to;
        $poll_id                    =   $this->filter_poll_id;
        $this->filter_description   =   "";
        $this->result_count         =   0;

        $desc = "";

        $query = Voter::query()->orderBy('created_at','DESC');

        $query->orWhere('ip_address','like','%'.$this->search.'%')
        ->orWhere('browser','like','%'.$this->search.'%')
        ->orWhere('country','like','%'.$this->search.'%')
        ->orWhere('city','like','%'.$this->search.'%')
        ->orWhere('user_agent','like','%'.$this->search.'%')
        ->orWhere('device','like','%'.$this->search.'%')
        ->orWhere('platform','like','%'.$this->search.'%');

        if($poll_id != ''){
            $query->whereHas('votes', function($q) use ($poll_id){
                $q->where('poll_id', $poll_id);
            });

            $poll = Poll::find($poll_id);
            if($poll){
                $desc .= " for Poll: " . $poll->title;
            }
        }

        //Counting
        $this->result_count = $query->count();

        //Set Query
        $this->query = $query;
        //Write description
        $this->filter_description = $desc;

        return $query;

    }

    public function generateReport()
    {

        try{

            $filter_array = [
                'created_from'          =>  $this->filter_created_from,
                'created_to'            =>  $this->filter_created_to,
                'search'                =>  $this->search,
                'poll_id'               =>  $this->filter_poll_id,
            ];

            //reset report attribute
            if($this->filter_poll_id == ''){
                $this->dispatchBrowserEvent('alert',[
                    "type"      =>  "error",
                    'message'   =>  "Please select a Poll to generate report."
                ]);

                // return;
            }else{
                 $poll = Poll::find($this->filter_poll_id);
                dispatch(new GenerateVoterReport(Auth::user(),'Voters Report for Poll '.$poll->title, $filter_array));

                $this->dispatchBrowserEvent('alert',[
                    "type"      =>  "success",
                    'message'   =>  "Report Dispatched successfully. Please check Documents tab shortly."
                ]);
            }

        }catch(\Exception $ex){
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "$ex Something went wrong! We could not complete the task."
            ]);
        }
    }

}
