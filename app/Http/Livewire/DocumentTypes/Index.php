<?php

namespace App\Http\Livewire\DocumentTypes;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DocumentType as DocType;

class Index extends Component
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

    public $docTypeId;

    public $name, $description;

    public $updateDocType = false, $addDocType = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteDocTypeListner'=>'deleteDocType'
    ];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name'           => 'required',
        'description'    => 'required'
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
        $this->name               = '';
        $this->description        = '';
    }

    public function render()
    {

        $doc_types = DocType::where('name','like','%'.$this->search.'%')
        ->orderBy('name','DESC')
        ->paginate(10);

        return view('livewire.document-types.index',['doc_types'=>$doc_types])
        ->extends('layouts.app')
        ->section('content');
    }

    /**
     * Open Add document type form
     * @return void
     */
    public function addDocType()
    {
        $this->resetFields();
        $this->addDocType = true;
        $this->updateDocType = false;
    }

    /**
      * store the document type inputted document type data in the departments table
      * @return void
      */
    public function storeDocType()
    {
        $this->validate($this->rules);

        try {

            DocType::create([
                'name'                => $this->name,
                'description'         => $this->description,
            ]);

            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>'Document type Created Successfully!'
            ]);


            $this->resetFields();
            $this->addDocType = false;

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>'Something went wrong! We could not add the department.'
            ]);

        }
    }


    /**
     * show existing document type data in edit document type form
     * @param mixed $id
     * @return void
     */
    public function editDocType($id){
        try {

            $doc_type = DocType::findOrFail($id);
            if( !$doc_type) {

                $this->dispatchBrowserEvent('alert',[
                    'type'=>'error',
                    'message'=>'Document type not found'
                ]);

            } else {
                $this->name               = $doc_type->name;
                $this->description        = $doc_type->description;
                $this->docTypeId          = $doc_type->id;
                $this->updateDocType      = true;
                $this->addDocType         = false;
            }

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>'Something went wrong!'
            ]);

        }

    }

    /**
     * update the document type data
     * @return void
     */
    public function updateDocType()
    {

        $this->validate();

        try {

            DocType::whereId($this->docTypeId)->update([
                'name'                => $this->name,
                'description'         => $this->description,
            ]);

            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>'Document type Updated Successfully!'
            ]);

            $this->updateDocType = false;
            $this->resetFields();

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>'Something went wrong!'
            ]);

        }
    }


    /**
     * Cancel Add/Edit form and redirect to document type listing page
     * @return void
     */
    public function cancelDocType()
    {
        $this->addDocType = false;
        $this->updateDocType = false;
        $this->resetFields();
    }


     /**
     * delete specific document type data from the departments table
     * @param mixed $id
     * @return void
     */
    public function deleteDocType($id)
    {
        try{
            DocType::find($id)->delete();

            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Document type Deleted Successfully!"
            ]);

        }catch(\Exception $e){

            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something went wrong!"
            ]);

        }
    }
}
