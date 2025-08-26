<?php

namespace App\Http\Livewire\Candidates\Traits;
use App\Models\Candidate;
use App\Models\Poll;
use App\Jobs\GenerateCandidateReport;
use App\Jobs\UpdateAllCandidates;
use Str;
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
        $active                     =   $this->filter_active;
        $this->filter_description   =   "";
        $this->result_count         =   0;

        $desc = "";

        $query = Candidate::query()->orderBy('name','ASC');

        $query->where('title','like','%'.$this->search.'%')
              ->orWhere('name','like','%'.$this->search.'%')
              ->orWhereHas('politicalParty', function($q){
                  $q->where('title','like','%'.$this->search.'%');
              });


        //Counting
        $this->result_count = $query->count();

        //Set Query
        $this->query = $query;
        //Write description
        $this->filter_description = $desc;

        return $query;

    }

    public function updateCandidates()
    {
        dispatch(new UpdateAllCandidates(3));
    }

    public function generateReport()
    {

        try{

            $this->generate_report = false;

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
                $report_title = Str::limit('Candidates Report for Poll'.$poll->title, 100, '...');
                dispatch(new GenerateCandidateReport(Auth::user()->id,$report_title, $filter_array));

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
