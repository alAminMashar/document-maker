<?php

namespace App\Http\Livewire\FrontEnd;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Poll;
use Carbon\Carbon;


class Polls extends Component
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

    /**
     * delete action listener
     */
    protected $listeners = [
    ];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'search'             =>  'nullable|min:1',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        $polls = Poll::where('title','like','%'.$this->search.'%')
        // ->where('ending_at','>=',Carbon::now())
        ->orderBy('created_at','DESC')
        ->paginate(config('app.paginate'));

        return view('livewire.front-end.polls',compact('polls'))
        ->extends('frontend.layouts.app')
        ->section('content');
    }

}
