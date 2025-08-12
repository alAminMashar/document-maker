<?php

namespace App\Http\Livewire\Candidates;

use Livewire\WithPagination;
use Livewire\Component;

use App\Models\Candidate;
use App\Models\PoliticalParty as Party;

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

    public $candidateId;

    public $name, $title, $political_party_id, $vote_count, $multiplier, $active;

    public $updateCandidate = false, $addCandidate = false;

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
        'name'                  =>  'required|unique:candidates',
        'title'                 =>  'required',
        'political_party_id'    =>  'required|exists:political_parties,id',
        'vote_count'            =>  'nullable',
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
        $this->vote_count            =   0;
        $this->multiplier            =   '';
        $this->active                =   '';
    }


    public $parties;

    public function mount()
    {
        $this->parties = Party::orderBy('title','ASC')->get(['id','title']);
    }

    public function render()
    {

        $candidates = Candidate::where('name','like','%'.$this->search.'%')
        ->orderBy('name','ASC')
        ->paginate(config('app.paginate'));

        return view('livewire.candidates.index',['candidates'=>$candidates])
        ->extends('layouts.app')
        ->section('content');

    }

    /**
     * Open Add Party form
     * @return void
     */
    public function addCandidate()
    {
        $this->resetFields();
        $this->addCandidate = true;
        $this->updateCandidate = false;
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
                'message'   =>  "Something went wrong! We could not add the topic."
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
            'name'                  =>  'required|unique:candidates,name,'.$this->candidateId,
            'title'                 =>  'required',
            'political_party_id'    =>  'required|exists:political_parties,id',
            'vote_count'            =>  'nullable',
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
