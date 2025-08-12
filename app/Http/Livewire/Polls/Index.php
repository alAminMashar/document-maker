<?php

namespace App\Http\Livewire\Polls;

use Livewire\WithPagination;
use Livewire\Component;

use App\Models\Poll;
use Carbon\Carbon;
use Auth;

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

    public $pollId;

    public $title, $description, $starting_at, $ending_at, $user_id;

    public $updatePoll = false, $addPoll = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deletePollListner'    =>  'deletePoll'
    ];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'title'             =>  'required|unique:polls,title',
        'description'       =>  'required|min:5',
        'starting_at'       =>  'required|date',
        'ending_at'         =>  'required|date|after:starting_at',
        'user_id'           =>  'required|exists:users,id',
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
        $this->title            =  '';
        $this->description      =  '';
        $this->starting_at      =  '';
        $this->ending_at        =  '';
        $this->user_id          =  Auth::user()->id;
    }

    public function mount()
    {
    }

    public function render()
    {

        $polls = Poll::where('title','like','%'.$this->search.'%')
        ->orderBy('created_at','DESC')
        ->paginate(config('app.paginate'));

        return view('livewire.polls.index',compact('polls'))
        ->extends('layouts.app')
        ->section('content');

    }

    /**
     * Open Add Party form
     * @return void
     */
    public function addPoll()
    {
        $this->resetFields();
        $this->addPoll = true;
        $this->updatePoll = false;
    }

    /**
      * store the Party inputted Party data in the parties table
      * @return void
      */
    public function storePoll()
    {

        $validated = $this->validate();

        try {

            Poll::create($validated);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Poll Created Successfully!"
            ]);

            $this->resetFields();
            $this->addPoll = false;

        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong! We could not add the topic."
            ]);
        }
    }


    /**
     * show existing Poll data in edit Poll form
     * @param mixed $id
     * @return void
     */
    public function editPoll(Poll $poll){
        try {
            $this->pollId           =  $poll->id;
            $this->title            =  $poll->title;
            $this->description      =  $poll->description;
            $this->starting_at      =  $poll->starting_at;
            $this->ending_at        =  $poll->ending_at;
            $this->updatePoll       =  true;
            $this->addPoll          =  false;
        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);
        }
    }

    /**
     * update the Poll data
     * @return void
     */
    public function updatePoll(){

        $validated = $this->validate([
            'title'             =>  'required|unique:polls,title,'.$this->pollId,
            'description'       =>  'required|min:5',
            'starting_at'       =>  'required|date',
            'ending_at'         =>  'required|date|after:starting_at',
            'user_id'           =>  'required|exists:users,id',
        ]);

        try {

            Poll::whereId($this->pollId)->update($validated);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Poll updated successfully!"
            ]);

            $this->updatePoll = false;
            $this->resetFields();

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }
    }

    /**
     * Cancel Add/Edit form and redirect to Poll listing page
     * @return void
     */
    public function cancelPoll()
    {
        $this->addPoll = false;
        $this->updatePoll = false;
        $this->resetFields();
    }


     /**
     * delete specific Poll data from the topics table
     * @param mixed $id
     * @return void
     */
    public function deletePoll(Poll $poll)
    {
        try{

            if(!$poll->hasVotes){
                $poll->delete();
            }

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Poll deleted successfully!"
            ]);
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);
        }
    }
}
