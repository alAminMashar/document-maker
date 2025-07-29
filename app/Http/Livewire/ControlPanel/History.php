<?php

namespace App\Http\Livewire\ControlPanel;

use App\Models\ModificationPayload;
use App\Models\Modification;
use App\Models\Disapproval;
use App\Models\Approval;

use App\Jobs\RunMaintenance;

use Auth;

use Livewire\WithPagination;
use Livewire\Component;

class History extends Component
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

    public $active_tab = 0;

    public $reason, $current_type;

    public $total_requests, $pending_count;

    public $deployments_count, $onboarding_count, $salary_advance_count, $salary_bonus_count, $gear_count, $termination_count, $charge_count;

    public $pending_deployments_count, $pending_onboarding_count, $pending_salary_advance_count, $pending_salary_bonus_count,  $pending_gear_count, $pending_termination_count, $pending_charge_count;

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

    public function runMaintenance()
    {
        $maintenance_task = new RunMaintenance();
        dispatch($maintenance_task);
    }

    public function mount()
    {
        /*------------------------------------------------------------------------
        #
        # All Counters
        #
        --------------------------------------------------------------------------*/
        $this->total_requests   =   Modification::all()
        ->count();

        $this->pending_count =  Modification::whereActive(true)
        ->count();

        $this->termination_count    =   Modification::where('modifiable_type','=','App\\Models\\EmployeeTermination')
        ->whereActive(false)
        ->count();

        $this->deployments_count    =   Modification::where('modifiable_type','=','App\\Models\\EmployeeDeployment')
        ->whereActive(false)
        ->count();

        $this->onboarding_count =   Modification::where('modifiable_type','=','App\\Models\\Employee')
        ->whereActive(false)
        ->count();

        $this->salary_advance_count =   Modification::where('modifiable_type','=','App\\Models\\SalaryAdvance')
        ->whereActive(false)
        ->count();

        $this->salary_bonus_count =   Modification::where('modifiable_type','=','App\\Models\\SalaryBonus')
        ->whereActive(false)
        ->count();

        $this->gear_count   =   Modification::where('modifiable_type','=','App\\Models\\Gear')
        ->whereActive(false)
        ->count();

        $this->inventory_count  =   Modification::where('modifiable_type','=','App\\Models\\InventoryRecord')
        ->whereActive(false)
        ->count();


        /*------------------------------------------------------------------------
        #
        # Active/Pending Modification Requests.
        #
        --------------------------------------------------------------------------*/
        $this->active_termination    =   Modification::whereActive(false)
        ->take(config('app.paginate'))
        ->get();


    }



    public function changeFilter($type)
    {

        try {

            if($type == 1){
                $this->current_type = 'EmployeeDeployment';
            }elseif($type == 2){
                $this->current_type = 'Employee';
            }elseif($type == 3){
                $this->current_type = 'EmployeeTermination';
            }elseif($type == 4){
                $this->current_type = 'Gear';
            }elseif($type == 5){
                $this->current_type = 'SalaryAdvance';
            }elseif($type == 8){
                $this->current_type = 'SalaryBonus';
            }elseif($type == 6){
                $this->current_type = 'InventoryRecord';
            }elseif($type == 7){
                $this->current_type = 'Deduction';
            }else{
                $this->current_type = null;
            }

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Showing results for $this->current_type"
            ]);

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Ooops! Something went wrong!"
            ]);

        }
    }

    public function render()
    {

        if($this->current_type){

            $mods = Modification::where('modifiable_type','=','App\\Models\\'.$this->current_type)
            ->whereActive(false)
            ->where('description','like','%'.$this->search.'%')
            ->orderBy('created_at','DESC')
            ->paginate(config('app.paginate'));

        }else{

            $mods = Modification::where('description','like','%'.$this->search.'%')
            ->whereActive(false)
            ->orderBy('created_at','DESC')
            ->paginate(config('app.paginate'));

        }

        return view('livewire.control-panel.history',['modifications'=>$mods])
        ->extends('layouts.app')
        ->section('content');

    }

}
