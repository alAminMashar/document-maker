<?php

namespace App\Exports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithCustomQuerySize;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use App\Models\Modification;

class ChangeReportExport implements FromView, ShouldAutoSize, ShouldQueue
{
    use Exportable;

    public $change_type, $start_date, $end_date, $search_key, $active;

    public $timeout = 3300;

    public function __construct($change_type, $start_date, $end_date, $search_key, $active)
    {
        ini_set('max_execution_time', 3600); // 3600 seconds = 60 minutes
        set_time_limit(3600);

        $this->change_type = $change_type;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->search_key = $search_key;
        $this->active = $active;
    }


    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {

        $change_type = $this->change_type;
        $end_date = $this->end_date;
        $start_date = $this->start_date;
        $search_key = $this->search_key;
        $active = $this->active;
        $desc = "Changes done on the system ";
        $query = Modification::query();

        if($search_key != ''){
            $query->where('description','like','%'.$search_key.'%');
            $desc = $desc." matching key word $search_key";
        }

        if($start_date != '') {
            $query->where('created_at','>=',$start_date);
            $desc   =   $desc." ranging from ".$start_date.", ";
        }

        if($end_date != '') {
            $query->where('created_at','<=',$end_date);
            $desc   =   $desc." to ".$end_date;
        }

        if($change_type != ''){
            $query->where('modifiable_type','=','App\\Models\\'.$change_type);
            $desc      =   "$desc $change_type.";
        }

        if($active != ''){
            $query->where('active',$active);
        }

        //Counting
        $result_count = $query->count();

        $modifications = $query
        ->with('user.department','approvals.user','disapprovals.user','modifiable')
        ->withCount('approvals','disapprovals')
        ->orderBy('created_at','ASC')
        ->get();

        return view('livewire.control-panel.exportables.period_change_type_report', [
            'modifications'         =>  $modifications,
            'change_type'           =>  $change_type,
            'report_description'    =>  $desc,
            'result_count'          =>  $result_count,
        ]);

    }

}
