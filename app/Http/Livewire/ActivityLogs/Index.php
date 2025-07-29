<?php

namespace App\Http\Livewire\ActivityLogs;

// use Spatie\Activitylog\Contracts\Activity as Activity;
use App\Models\AuditTrail as Activity;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    /*-----------------------------------------------

        Search Stuff and Pagination

     *----------------------------------------------*/

    use WithPagination;
    // use Livewire\WithPagination; add this to top

    public $search = '';

    public function updateSearch(){
        $this->resetPage();
    }

    protected $paginationTheme = 'bootstrap';

     /*-----------------------------------------------

        End of Search Stuff and Pagination

     *----------------------------------------------*/

    protected $rules = [
        'search'    =>  'required',
    ];

    public $activitieId;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Reseting all inputted fields
     * activity()->log('Look mum, I logged something');
     * @return void
     */
    public function resetFields(){
        $this->causer      = '';
        $this->subject     = '';
    }

    public function render()
    {

        $activities = Activity::where('properties','like','%'.$this->search.'%')
        ->orWhere('subject_type','like','%'.$this->search.'%')
        ->orderBy('created_at','DESC')
        ->paginate(config('app.paginate'));

        return view('livewire.activity-logs.index',['logs'=>$activities])
        ->extends('layouts.app')
        ->section('content');

    }

}
