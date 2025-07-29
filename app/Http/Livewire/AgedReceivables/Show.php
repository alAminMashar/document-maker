<?php

namespace App\Http\Livewire\AgedReceivables;

use Livewire\Component;
use App\Http\Livewire\AgedReceivables\Traits\Show\DataTrait;
use App\Http\Livewire\AgedReceivables\Traits\Show\FilterTrait;
use App\Models\FinancialPeriod as Period;
use Livewire\WithPagination;

class Show extends Component
{

    use WithPagination, DataTrait, FilterTrait;

    protected $paginationTheme = 'bootstrap';

    public $period;

    public function mount(Period $period)
    {
        $this->period = $period;
        $this->loadData();
    }

    public function render()
    {
        $accounts = $this->filter()
        ->paginate(config('app.paginate'));

        if($this->generate_report) {
            $this->generateReport();
        }

        return view('livewire.aged-receivables.show')
            ->with('accounts', $accounts)
            ->extends('layouts.app')
            ->section('content');
    }
}
