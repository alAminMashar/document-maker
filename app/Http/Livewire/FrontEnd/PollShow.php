<?php

namespace App\Http\Livewire\FrontEnd;

use App\Http\Livewire\FrontEnd\Traits\VoteTrait;
use App\Http\Livewire\FrontEnd\Traits\FingerPrintTrait;

use Livewire\Component;
use Livewire\WithPagination;


use App\Models\Poll;
use App\Models\Candidate;
use App\Models\Voter;
use App\Models\Vote;

class PollShow extends Component
{
    use WithPagination, VoteTrait, FingerPrintTrait;

    public $search = '';
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'submitVoteListener' => 'submitVote',
        'storeFingerprint'   => 'storeFingerprint',
    ];

    protected $rules = [
        'search' => 'nullable|min:1',
    ];

    public $poll, $candidates, $voter, $vote, $total_votes = 0;
    public $hasVoted = false;

    public function updateSearch()
    {
        $this->resetPage();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(Poll $poll)
    {
        $this->poll = $poll;

        $this->candidates = Candidate::whereActive(1)
        ->wherePollId($poll->id)
        ->orderBy('name', 'ASC')
        ->get();

        $this->fetchVoter();
        $this->checkVoteStatus();
    }

    public function render()
    {
        return view('livewire.front-end.poll-show')
            ->extends('frontend.layouts.app')
            ->section('content');
    }


}
