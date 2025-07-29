<?php

namespace App\Http\Livewire\Tag;

use Livewire\WithPagination;
use Livewire\Component;

use App\Models\Tag;

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

    public $tagId;

    public $title;

    public $updateTag = false, $addTag = false;



    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteTagListner'    =>  'deleteTag'
    ];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'title'           =>    'required|unique:tags',
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
    }

    public function render()
    {

        $tags = Tag::where('title','like','%'.$this->search.'%')
        ->orderBy('title','ASC')
        ->paginate(config('app.paginate'));

        return view('livewire.tag.index',['tags'=>$tags])
        ->extends('layouts.app')
        ->section('content');

    }

    /**
     * Open Add Tag form
     * @return void
     */
    public function addTag()
    {
        $this->resetFields();
        $this->addTag = true;
        $this->updateTag = false;
    }

    /**
      * store the Tag inputted Tag data in the tags table
      * @return void
      */
    public function storeTag()
    {
        $validated = $this->validate();

        try {

            Tag::create($validated);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Tag Created Successfully!"
            ]);


            $this->resetFields();
            $this->addTag = false;

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong! We could not add the tag."
            ]);

        }
    }


    /**
     * show existing Tag data in edit Tag form
     * @param mixed $id
     * @return void
     */
    public function editTag(Tag $tag){
        try {

            $this->tagId          =   $tag->id;
            $this->title          =   $tag->title;
            $this->updateTag      =   true;
            $this->addTag         =   false;

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }

    }

    /**
     * update the Tag data
     * @return void
     */
    public function updateTag(){

        $validated = $this->validate([
            'title'         => 'required|unique:tags,title,'.$this->tagId,
        ]);

        try {

            Tag::whereId($this->tagId)->update($validated);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Tag updated successfully!"
            ]);

            $this->updateTag = false;
            $this->resetFields();

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }
    }


    /**
     * Cancel Add/Edit form and redirect to Tag listing page
     * @return void
     */
    public function cancelTag()
    {
        $this->addTag = false;
        $this->updateTag = false;
        $this->resetFields();
    }


     /**
     * delete specific Tag data from the tags table
     * @param mixed $id
     * @return void
     */
    public function deleteTag(Tag $tag)
    {
        try{

            $tag->delete();

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Tag deleted successfully!"
            ]);

        }catch(\Exception $e){

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }
    }
}
