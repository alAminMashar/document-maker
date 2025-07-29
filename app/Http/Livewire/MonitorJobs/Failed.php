<?php

namespace App\Http\Livewire\MonitorJobs;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use App\Http\Livewire\MonitorJobs\Traits\FailedJobs;
use App\Http\Livewire\MonitorJobs\Traits\JobCounts;
use App\Http\Livewire\MonitorJobs\Traits\AdminTasksTrait;

class Failed extends Component
{

    use FailedJobs, JobCounts, AdminTasksTrait;

    public function mount()
    {
        $this->loadCounts();
        $this->loadFailedJobs();
    }

    public function render()
    {
        return view('livewire.monitor-jobs.failed')
        ->extends('layouts.app')
        ->section('content');
    }
}
