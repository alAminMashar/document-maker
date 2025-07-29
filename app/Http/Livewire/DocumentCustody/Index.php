<?php

namespace App\Http\Livewire\DocumentCustody;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\DocumentType;
use App\Models\Document;
use App\Models\User;

class Index extends Component
{
    /*-----------------------------------------------

        Search Stuff and Pagination

     *----------------------------------------------*/

    use WithPagination;
    use WithFileUploads;
    // use Livewire\WithPagination; add this to top

    public $search = '';

    public function updateSearch(){
        $this->resetPage();
    }

    protected $paginationTheme = 'bootstrap';

     /*-----------------------------------------------

        End of Search Stuff and Pagination

     *----------------------------------------------*/

    public $documentId;

    public $users, $document_types;

    public $document, $documentable_id, $documentable_type, $document_type_id, $original_received, $url;

    public $addDocument = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteDocumentListner'=>'deleteDocument'
    ];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'search'    =>  'min:0',
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
        $this->document             =   '';
        $this->document_type_id     =   '';
        $this->documentable_id      =   '';
        $this->original_received    =   '';
    }

    public function render()
    {

        $this->users = User::where('active','=',1)
        ->orderBy('name','ASC')
        ->get();

        $this->document_types = DocumentType::all();

        $documents = Document::where('slug','like','%'.$this->search.'%')
        ->orderBy('created_at','DESC')
        ->paginate(config('app.paginate'));

        return view('livewire.document-custody.index',['documents'=>$documents])
        ->extends('layouts.app')
        ->section('content');

    }

    /**
     * Open Add Document form
     * @return void
     */
    public function addDocument()
    {
        $this->resetFields();
        $this->addDocument = true;
    }


    /**
     * Cancel Add/Edit form and redirect to Document listing page
     * @return void
     */
    public function cancelDocument()
    {
        $this->addDocument = false;
        $this->resetFields();
    }


     /**
     * delete specific Document data from the Documents table
     * @param mixed $id
     * @return void
     */
    public function deleteDocument($id)
    {
        try{
            $doc = Document::find($id);
            $filepath = 'document'.'/'.$doc->file_name;
            if(File::exists($filepath)){
                File::delete($filepath);
            }

            Document::find($id)->delete();

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Document Deleted Successfully!"
            ]);

        }catch(\Exception $e){

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }
    }
}
