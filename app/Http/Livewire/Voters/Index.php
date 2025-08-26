<?php

namespace App\Http\Livewire\Voters;
use App\Http\Livewire\Voters\Traits\FilterTrait;
use Livewire\WithPagination;
use Livewire\Component;

use App\Models\Voter;
use App\Models\Document;
use App\Models\Poll;

class Index extends Component
{

    /*-----------------------------------------------

        Search Stuff and Pagination

     *----------------------------------------------*/
    use WithPagination, FilterTrait;

    // use Livewire\WithPagination; add this to top

    public $search = '';

    public function updateSearch(){
        $this->resetPage();
    }

    protected $paginationTheme = 'bootstrap';

     /*-----------------------------------------------

        End of Search Stuff and Pagination

     *----------------------------------------------*/

    public $voterId;

    public $name, $phone_number, $email, $browser, $ip_address, $country, $city, $user_agent, $device, $platform, $referer, $cookier_value;

    public $updateVoter = false, $addVoter = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteVoterListner'    =>  'deleteVoter'
    ];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name'              =>  'nullable',
        'phone_number'      =>  'nullable',
        'email'             =>  'nullable',
        'browser'           =>  'nullable',
        'ip_address'        =>  'nullable',
        'country'           =>  'nullable',
        'city'              =>  'nullable',
        'user_agent'        =>  'nullable',
        'device'            =>  'nullable',
        'platform'          =>  'nullable',
        'referer'           =>  'nullable',
        'cookier_value'     =>  'nullable',
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
        $this->name             =   '';
        $this->phone_number     =   '';
        $this->email            =   '';
        $this->browser          =   '';
        $this->ip_address       =   '';
        $this->country          =   '';
        $this->city             =   '';
        $this->user_agent       =   '';
        $this->device           =   '';
        $this->platform         =   '';
        $this->referer          =   '';
        $this->cookier_value    =   '';
    }

    public $voter_count, $polls;

    public function mount()
    {
        $this->voter_count = Voter::count();
        $this->polls = Poll::orderBy('title','ASC')->get(['id','title']);
    }

    public function render()
    {
        $documents = Document::whereHas('type', function($q){
            $q->where('name','=','Voters Report');
        })->orderBy('created_at', 'DESC')
        ->paginate(config('app.paginate'));

        $voters = $this->filter()->paginate(config('app.paginate'));

        if($this->filter){
            $this->generate_report = false;
            $this->generateReport();
        }

        return view('livewire.voters.index',compact('voters','documents'))
        ->extends('layouts.app')
        ->section('content');

    }

    /**
     * Open Add Party form
     * @return void
     */
    public function addVoter()
    {
        $this->resetFields();
        $this->addVoter = true;
        $this->updateVoter = false;
    }

    /**
      * store the Party inputted Party data in the parties table
      * @return void
      */
    public function storePoll()
    {

        $validated = $this->validate();

        try {

            Voter::create($validated);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Voter Created Successfully!"
            ]);

            $this->resetFields();
            $this->addVoter = false;

        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong! We could not add the topic."
            ]);
        }
    }


    /**
     * show existing Voter data in edit Voter form
     * @param mixed $id
     * @return void
     */
    public function editVoter(Voter $voter){
        try {
            $this->voterId           =   $voter->id;
            $this->name             =   $voter->name;
            $this->phone_number     =   $voter->phone_number;
            $this->email            =   $voter->email;
            $this->browser          =   $voter->browser;
            $this->ip_address       =   $voter->ip_address;
            $this->country          =   $voter->country;
            $this->city             =   $voter->city;
            $this->user_agent       =   $voter->user_agent;
            $this->device           =   $voter->device;
            $this->platform         =   $voter->platform;
            $this->referer          =   $voter->referer;
            $this->cookier_value    =   $voter->cookier_value;
            $this->updateVoter       =  true;
            $this->addVoter          =  false;
        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);
        }
    }

    /**
     * update the Voter data
     * @return void
     */
    public function updateVoter(){

        $validated = $this->validate();

        try {

            Voter::whereId($this->voterId)->update($validated);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Voter updated successfully!"
            ]);

            $this->updateVoter = false;
            $this->resetFields();

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }
    }

    /**
     * Cancel Add/Edit form and redirect to Voter listing page
     * @return void
     */
    public function cancelPoll()
    {
        $this->addVoter = false;
        $this->updateVoter = false;
        $this->resetFields();
    }


     /**
     * delete specific Voter data from the topics table
     * @param mixed $id
     * @return void
     */
    public function deleteVoter(Voter $voter)
    {
        try{

            if(!$voter->hasVotes){
                $voter->delete();
            }

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Voter deleted successfully!"
            ]);
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);
        }
    }
}
