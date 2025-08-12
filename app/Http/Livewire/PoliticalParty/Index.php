<?php

namespace App\Http\Livewire\PoliticalParty;

use Livewire\WithPagination;
use Livewire\Component;

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

    public $partyId;

    public $title, $description;

    public $updateParty = false, $addParty = false;



    /**
     * delete action listener
     */
    protected $listeners = [
        'deletePartyListner'    =>  'deleteParty'
    ];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'title'           =>    'required|unique:political_parties,title',
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

        $parties = Party::where('title','like','%'.$this->search.'%')
        ->orderBy('title','ASC')
        ->paginate(config('app.paginate'));

        return view('livewire.political-party.index',['parties'=>$parties])
        ->extends('layouts.app')
        ->section('content');

    }

    /**
     * Open Add Party form
     * @return void
     */
    public function addParty()
    {
        $this->resetFields();
        $this->addParty = true;
        $this->updateParty = false;
    }

    /**
      * store the Party inputted Party data in the parties table
      * @return void
      */
    public function storeParty()
    {
        $validated = $this->validate();

        try {

            Party::create($validated);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Party Created Successfully!"
            ]);


            $this->resetFields();
            $this->addParty = false;

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong! We could not add the party."
            ]);

        }
    }


    /**
     * show existing Party data in edit Party form
     * @param mixed $id
     * @return void
     */
    public function editParty(Party $party){
        try {

            $this->partyId          =   $party->id;
            $this->title            =   $party->title;
            $this->description      =   $party->description;
            $this->updateParty      =   true;
            $this->addParty         =   false;

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }

    }

    /**
     * update the Party data
     * @return void
     */
    public function updateParty(){

        $validated = $this->validate([
            'title'         => 'required|unique:political_parties,title,'.$this->partyId,
            'description'   => 'required',
        ]);

        try {

            Party::whereId($this->partyId)->update($validated);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Party updated successfully!"
            ]);

            $this->updateParty = false;
            $this->resetFields();

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }
    }


    /**
     * Cancel Add/Edit form and redirect to Party listing page
     * @return void
     */
    public function cancelParty()
    {
        $this->addParty = false;
        $this->updateParty = false;
        $this->resetFields();
    }


     /**
     * delete specific Party data from the partys table
     * @param mixed $id
     * @return void
     */
    public function deleteParty(Party $party)
    {
        try{

            $party->delete();

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Party deleted successfully!"
            ]);

        }catch(\Exception $e){

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }
    }
}
