<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Poll;
use Carbon\Carbon;

class PollCountdown extends Component
{
    public Poll $poll;
    public $endTime; // JS will use this
    public $remainingSeconds;

    public function mount(Poll $poll)
    {
        $this->poll = $poll;

        // End time calculation
        $this->endTime = $poll->starting_at
            ->addMinutes($poll->duration) // if duration is in minutes
            ->timestamp;

        $this->remainingSeconds = $this->endTime - now()->timestamp;
    }

    public function render()
    {
        return view('livewire.poll-countdown');
    }
}
