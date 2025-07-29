<?php

namespace App\Http\Livewire\Topic;

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

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields(){
        $this->title            = '';
        $this->description      = '';
    }

    public function render()
    {

        $topics = Topic::where('title','like','%'.$this->search.'%')
        ->orderBy('title','ASC')
        ->paginate(config('app.paginate'));

        return view('livewire.topic.index',['topics'=>$topics])
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
