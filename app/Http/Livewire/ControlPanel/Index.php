<?php

namespace App\Http\Livewire\ControlPanel;

use App\Models\Modification;
use App\Models\Document;

use App\Jobs\GenerateChangeReport;
use Auth;


use Livewire\WithPagination;
use Livewire\Component;

class Index extends Component
{
    /*-----------------------------------------------

        Search Stuff and Pagination

     *----------------------------------------------*/

    use WithPagination;

    public $search = '';

    public function updateSearch(){
        $this->resetPage();
    }

    protected $paginationTheme = 'bootstrap';

     /*-----------------------------------------------

        End of Search Stuff and Pagination

     *----------------------------------------------*/

    public $modificationId;

    public $reason, $type_names, $documents;

    public $approval = false, $disapproval = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteModificationListner' =>  'deleteModification',
    ];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'reason'    =>  '',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields(){
        $this->reason      = '';
    }

    public function mount()
    {
        $this->type_names = Modification::getTypeNames();

        $this->documents = Document::whereDocumentTypeId(19)
        ->orderBy('created_at','DESC')
        ->get();
    }


    //filter variables
    public  $filter_type, $filter_description, $result_count, $filter_created_from, $filter_created_to, $generate_report = false, $filter = false, $active = true;

    protected $query;

    public function clearFilter(){
        $this->query                =   '';
        $this->filter_type          =   '';
        $this->filter_description   =   '';
        $this->result_count         =   0;
        $this->active               =   true;
        $this->filter               =   false;
        $this->generate_report      =   false;
        $this->filter_created_from  =   '';
        $this->filter_created_to    =   '';
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
        $this->filter_description   =   "";
        $this->result_count         =   0;
        $active                   =  $this->active;
        $type                     =   $this->filter_type;

        $desc = "";

        $query = Modification::query();

        $query->where('description','like','%'.$this->search.'%');

        if($created_from != '') {
            $query->where('created_at','>=',$created_from);
            $desc   =   $desc." end range from ".$created_from.", ";
        }

        if($created_to != '') {
            $query->where('created_at','<=',$created_to);
            $desc   =   $desc." end range to ".$created_to.", ";
        }

        if($type != '') {
            $query->where('modifiable_type','=','App\\Models\\'.$type);
            $desc      =   "$desc $type ";
        }

        if($active){
            $query->where('active','=',1);
            $active_desc      =   $active?'pending ':'past ';
            $desc = "$desc $active_desc changes";
        }

        //Counting
        $this->result_count = $query->count();

        //Set Query
        $this->query = $query;
        //Write description
        $this->filter_description = $desc;

        return $query;

    }

    public function render()
    {

        //Report Generation
        if($this->generate_report){
            //reset report attribute
            $this->generate_report = false;
            $report_task = new GenerateChangeReport(Auth::user(), $this->filter_type, $this->filter_created_from, $this->filter_created_to, $this->search, $this->active);
            dispatch($report_task);
        }

        $modifications = $this->filter();
        $modifications = $modifications
        ->with('user.department','approvals.user','disapprovals.user','modifiable')
        ->withCount('approvals','disapprovals')
        ->orderBy('created_at','ASC')
        ->paginate(config('app.paginate'));

        return view('livewire.control-panel.index',['modifications'=>$modifications])
        ->extends('layouts.app')
        ->section('content');

    }

    /**
      * Approve the modification.
      * @return void
    */
    public function approve(Modification $modification, $reason = 'N/A')
    {
        try {

            $modification->approve($reason);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>   "Request for ".$modification->description." was approved successfully."
            ]);

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "$ex Ooops! Something went wrong!"
            ]);

        }

    }

    /**
      * Disapprove the modification.
      * @return void
    */
    public function disapprove(Modification $modification, $reason = 'N/A')
    {
        try {

            $modification->disapprove($reason);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Request for ".$modification->description." was dissapproved successfully."
            ]);

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Ooops! Something went wrong!"
            ]);

        }

    }

     /**
     * delete specific Modification data from the suppliers table
     * @param mixed $id
     * @return void
     */
    public function deleteModification(Modification $mod)
    {
        try{
            //Check if it is deletable
            $response = $mod->deletable();

            //If condition is met, delete
            if($response){
                $mod->cleanItUp();
                $mod->delete();
            }

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  $mod->description." was deleted successfully."
            ]);

        }catch(\Exception $e){

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }
    }

}
