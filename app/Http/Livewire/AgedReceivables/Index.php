<?php

namespace App\Http\Livewire\AgedReceivables;

use App\Http\Livewire\Customer\Traits\GenerateAgedAccountTrait;
use App\Http\Livewire\AgedReceivables\Traits\FilterTrait;
use App\Http\Livewire\AgedReceivables\Traits\DataTrait;
use App\Http\Livewire\Common\Traits;
use Livewire\WithPagination;
use Livewire\Component;

class Index extends Component
{

    use  WithPagination, GenerateAgedAccountTrait, DataTrait, FilterTrait, TabMemoryTrait;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'financial_period_id' => 'exists:financial_periods,id',
    ];

    public function mount()
    {
        $this->loadData();
        $this->loadAgedReportData();
        // set the current tab from the TabMemoryTrait
        if($this->current_tab == ''){
            $this->switchTab('index-tab');
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $active_periods = $this->filter()->paginate(config('app.paginate'));

        return view('livewire.aged-receivables.index', compact('active_periods'))
        ->extends('layouts.app')
        ->section('content');
    }
}
