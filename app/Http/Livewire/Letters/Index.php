<?php

namespace App\Http\Livewire\Letters;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Letters\Traits\CRUDTrait;
use App\Http\Livewire\Letters\Traits\DataTrait;
use App\Http\Livewire\Letters\Traits\FilterTrait;
use App\Http\Livewire\Letters\Traits\FormSetupTrait;


class Index extends Component
{

    use WithPagination, DataTrait, FormSetupTrait, CRUDTrait, FilterTrait;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteLetterListner'   =>  'deleteLetter',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->mountData();
    }

    /**
     * Write code on Method
     */
    public function render()
    {

        $letters = $this->filter()->paginate(config('app.paginate'));

        return view('livewire.letters.index',compact('letters'))
        ->extends('layouts.app')
        ->section('content');

    }
}
