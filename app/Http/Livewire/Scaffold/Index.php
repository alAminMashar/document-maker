<?php

namespace App\Http\Livewire\Scaffold;

use Livewire\WithPagination;
use Livewire\Component;

use App\Models\Topic;

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

    public $topicId;

    public $title, $description;

    public $updateTopic = false, $addTopic = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteTopicListner'    =>  'deleteTopic'
    ];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'title'           =>    'required|unique:topics',
        'description'     =>    'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {

        $this->statuses = Statuses::orderBy('name','DESC')->get();

    }

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields(){
        $this->title            = '';
        $this->description      = '';
    }

    //filter variables
    public $filter_description, $result_count, $filter_balance_min, $filter_balance_max, $filter_type, $filter_status, $approved = true, $filter = false;

    protected $query;

    public function clearFilter(){
        $this->filter_status            =   '';
        $this->filter_description       =   '';
        $this->result_count             =   0;
        $this->query                    =   '';
        $this->approved                 =   true;
        $this->filter                   =   false;
    }

    public function updateFilter()
    {
        //Activate Filter
        $this->filter = true;
        $this->render();

    }

    public function filter()
    {

        $this->filter_description   =   "";
        $this->result_count         =   0;
        $status                     =   $this->filter_status;
        $approved                   =   $this->approved;

        $desc = "Showing filtered results for ";

        $query = Customers::query();

        $query->where('name','like','%'.$this->search.'%');

        if($status != '') {
            $query->where('status_id',$status);
            $statuses     =   Statuses::find($status);
            $desc   =   $desc.$statuses['name']." status, ";
        }

        $query->where('published',$approved);
        $approval_description = $approved?"approved.":"pending approval.";
        $desc   =   $desc.$approval_description;

        //Set Query
        $this->query = $query;
        //Write description
        $this->filter_description = $desc;
        //Result counter
        $this->result_count = $query->count();

        return $query;

    }

    public function render()
    {
        $customers = $this->filter();
        $customers = $customers->orderBy('name','ASC')
        ->paginate(config('app.paginate'));

        return view('livewire.customer.index',['customers'=>$customers])
        ->extends('layouts.app')
        ->section('content');
    }

    /**
     * Open Add Topic form
     * @return void
     */
    public function addTopic()
    {
        $this->resetFields();
        $this->addTopic = true;
        $this->updateTopic = false;
    }

    /**
      * store the Topic inputted Topic data in the topics table
      * @return void
      */
    public function storeTopic()
    {
        $validated = $this->validate();

        try {

            Topic::create($validated);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Topic Created Successfully!"
            ]);


            $this->resetFields();
            $this->addTopic = false;

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong! We could not add the topic."
            ]);

        }
    }


    /**
     * show existing Topic data in edit Topic form
     * @param mixed $id
     * @return void
     */
    public function editTopic(Topic $topic){
        try {

            $this->topicId          =   $topic->id;
            $this->title            =   $topic->title;
            $this->description      =   $topic->description;
            $this->updateTopic      =   true;
            $this->addTopic         =   false;

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }

    }

    /**
     * update the Topic data
     * @return void
     */
    public function updateTopic(){

        $validated = $this->validate([
            'title'         => 'required|unique:topics,title,'.$this->topicId,
            'description'   => 'required',
        ]);

        try {

            Topic::whereId($this->topicId)->update($validated);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Topic updated successfully!"
            ]);

            $this->updateTopic = false;
            $this->resetFields();

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }
    }


    /**
     * Cancel Add/Edit form and redirect to Topic listing page
     * @return void
     */
    public function cancelTopic()
    {
        $this->addTopic = false;
        $this->updateTopic = false;
        $this->resetFields();
    }


     /**
     * delete specific Topic data from the topics table
     * @param mixed $id
     * @return void
     */
    public function deleteTopic(Topic $topic)
    {
        try{

            $topic->delete();

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Topic deleted successfully!"
            ]);

        }catch(\Exception $e){

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }
    }
}
