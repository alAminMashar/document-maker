<?php

namespace App\Http\Livewire\SubTopic;

use Livewire\WithPagination;
use Livewire\Component;

use App\Models\Topic;
use App\Models\SubTopic;

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

    public $subTopicId;

    public $topics;

    public $title, $description, $topic_id;

    public $updateSubTopic = false, $addSubTopic = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteSubTopicListner'    =>  'deleteSubTopic'
    ];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'title'           =>    'required|unique:sub_topics',
        'description'     =>    'required',
        'topic_id'        =>    'required',
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
        $this->title            =   '';
        $this->description      =   '';
        $this->topic_id         =   '';
    }

    public function mount()
    {
        $this->topics = Topic::all();
    }

    public function render()
    {

        $sub_topics = SubTopic::where('title','like','%'.$this->search.'%')
        ->orderBy('title','ASC')
        ->paginate(config('app.paginate'));

        return view('livewire.sub-topic.index',['sub_topics'=>$sub_topics])
        ->extends('layouts.app')
        ->section('content');

    }

    /**
     * Open Add Topic form
     * @return void
     */
    public function addSubTopic()
    {
        $this->resetFields();
        $this->addSubTopic = true;
        $this->updateSubTopic = false;
    }

    /**
      * store the Topic inputted Topic data in the topics table
      * @return void
      */
    public function storeSubTopic()
    {

        $validated = $this->validate();

        try {

            SubTopic::create($validated);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Sub topic Created Successfully!"
            ]);

            $this->resetFields();
            $this->addSubTopic = false;

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
    public function editSubTopic(SubTopic $sub_topic){
        try {

            $this->subTopicId       =   $sub_topic->id;
            $this->title            =   $sub_topic->title;
            $this->description      =   $sub_topic->description;
            $this->topid_id         =   $sub_topic->topid_id;
            $this->updateSubTopic   =   true;
            $this->addSubTopic      =   false;

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
    public function updateSubTopic(){

        $validated = $this->validate([
            'title'         => 'required|unique:sub_topics,title,'.$this->subTopicId,
            'description'   => 'required',
            'topic_id'      => 'required',
        ]);

        try {

            SubTopic::whereId($this->subTopicId)->update($validated);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Sub topic updated successfully!"
            ]);

            $this->updateSubTopic = false;
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
    public function cancelSubTopic()
    {
        $this->addSubTopic = false;
        $this->updateSubTopic = false;
        $this->resetFields();
    }


     /**
     * delete specific Topic data from the topics table
     * @param mixed $id
     * @return void
     */
    public function deleteSubTopic(SubTopic $sub_topic)
    {
        try{

            $sub_topic->delete();

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Sub topic deleted successfully!"
            ]);

        }catch(\Exception $e){

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }
    }
}
