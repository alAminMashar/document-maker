<?php

namespace App\Http\Livewire\MonitorJobs;

use Livewire\Component;
use Livewire\WithPagination;

use App\Http\Livewire\MonitorJobs\Traits\PendingJobs;
use App\Http\Livewire\MonitorJobs\Traits\JobCounts;

class Index extends Component
{

    use WithPagination, PendingJobs, JobCounts;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->loadCounts();
        $this->loadPendingJobs();
    }

    public function render()
    {
        return view('livewire.monitor-jobs.index')
        ->extends('layouts.app')
        ->section('content');
    }

}
