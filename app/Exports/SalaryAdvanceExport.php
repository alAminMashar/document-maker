<?php

namespace App\Exports;

use App\Models\SalaryAdvance;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SalaryAdvanceExport implements FromView, ShouldAutoSize
{
    public $advance, $status, $employee;

    public function __construct($status = null)
    {
        $this->status = $status;
    }

    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {

        $advances = SalaryAdvance::where('settled','=',0)
        ->where('approved','=',1)
        ->get();

        return view('livewire.salary-advance.exportable.table', ['advances'  => $advances]);

    }
}
