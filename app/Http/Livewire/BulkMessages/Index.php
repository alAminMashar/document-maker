<?php

namespace App\Http\Livewire\BulkMessages;

use Livewire\Component;

class Index extends Component
{

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.bulk-messages.index')
        ->extends('layouts.app')
        ->section('content');
    }
}
