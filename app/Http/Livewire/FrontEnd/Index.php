<?php

namespace App\Http\Livewire\FrontEnd;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Poll;
use Carbon\Carbon;

class Index extends Component
{

    public $polls;

    public function mount()
    {
        $this->polls = Poll::where('ending_at','>=',Carbon::now())
        ->orderBy('created_at','DESC')
        ->take(3)
        ->get();
    }

    public function render()
    {
        return view('livewire.front-end.index')
        ->extends('frontend.layouts.app')
        ->section('content');
    }
}
