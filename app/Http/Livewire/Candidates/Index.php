<?php

namespace App\Http\Livewire\Candidates;
use Livewire\Component;
use App\Http\Livewire\Candidates\Traits\FilterTrait;
use Livewire\WithPagination;

use App\Models\Candidate;
use App\Models\PoliticalParty as Party;
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

    public $candidateId;

    public $name, $title, $poll_id, $political_party_id, $vote_count, $multiplier, $active;

    public $updateCandidate = false, $addCandidate = false, $addDocument = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteCandidateListner'    =>  'deleteCandidate'
    ];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name'                  =>  'required|',
        'poll_id'               =>  'required|exists:polls,id',
        'title'                 =>  'required',
        'political_party_id'    =>  'required|exists:political_parties,id',
        'multiplier'            =>  'required',
        'active'                =>  'required',
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
        $this->name                  =   '';
        $this->title                 =   '';
        $this->political_party_id    =   '';
        $this->poll_id               =   '';
        $this->multiplier            =   '';
        $this->active                =   '';
    }

    public $parties, $polls;

    public function mount()
    {
        $this->parties = Party::orderBy('title','ASC')->get(['id','title']);
        $this->polls   = Poll::orderBy('title','ASC')->get(['id','title']);
        $this->updateCandidates();//In FilterTrait
    }

    public function render()
    {
        $documents = Document::whereHas('type', function($q){
            $q->where('name','=','Candidate Report');
        })->orderBy('created_at', 'DESC')
        ->paginate(config('app.paginate'));

        $candidates = $this->filter()->paginate(config('app.paginate'));

        if($this->filter){
            $this->generate_report = false;
            $this->generateReport();
        }

        return view('livewire.candidates.index',compact('candidates','documents'))
        ->extends('layouts.app')
        ->section('content');

    }

    /**
     * Open Add Candidate form
     * @return void
     */
    public function addDocument($candidateId)
    {
        $this->candidateId = $candidateId;
        $this->addDocument = true;
        $this->addCandidate = false;
        $this->updateCandidate = false;
    }

    public function cancelDocument()
    {
        $this->addDocument = false;
    }

    /**
     * Open Add Candidate form
     * @return void
     */
    public function addCandidate()
    {
        $this->resetFields();
        $this->addCandidate = true;
        $this->updateCandidate = false;
        $this->addDocument = false;
    }

    /**
      * store the Party inputted Party data in the parties table
      * @return void
      */
    public function storeCandidate()
    {
        $validated = $this->validate();

        try {

            Candidate::create($validated);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Candidate Created Successfully!"
            ]);


            $this->resetFields();
            $this->addCandidate = false;

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong! We could not complete the task."
            ]);

        }
    }


    /**
     * show existing Candidate data in edit Candidate form
     * @param mixed $id
     * @return void
     */
    public function editCandidate(Candidate $candidate){
        try {
            $this->candidateId           =   $candidate->id;
            $this->name                  =   $candidate->name;
            $this->title                 =   $candidate->title;
            $this->political_party_id    =   $candidate->political_party_id;
            $this->poll_id               =   $candidate->poll_id;
            $this->vote_count            =   $candidate->vote_count;
            $this->multiplier            =   $candidate->multiplier;
            $this->active                =   $candidate->active;
            $this->updateCandidate       =   true;
            $this->addCandidate          =   false;
        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }

    }

    /**
     * update the Candidate data
     * @return void
     */
    public function updateCandidate(){

        $validated = $this->validate([
            'name'                  =>  'required',
            'title'                 =>  'required',
            'political_party_id'    =>  'required|exists:political_parties,id',
            'poll_id'               =>  'required|exists:polls,id',
            'multiplier'            =>  'required',
            'active'                =>  'required',
        ]);

        try {

            Candidate::whereId($this->candidateId)->update($validated);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Candidate updated successfully!"
            ]);

            $this->updateCandidate = false;
            $this->resetFields();

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }
    }

    /**
     * Cancel Add/Edit form and redirect to Candidate listing page
     * @return void
     */
    public function cancelCandidate()
    {
        $this->addCandidate = false;
        $this->updateCandidate = false;
        $this->resetFields();
    }


     /**
     * delete specific Candidate data from the topics table
     * @param mixed $id
     * @return void
     */
    public function deleteCandidate(Candidate $candidate)
    {
        try{

            if(!$candidate->hasVotes){
                $candidate->delete();
            }

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Candidate deleted successfully!"
            ]);
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);
        }
    }
}
