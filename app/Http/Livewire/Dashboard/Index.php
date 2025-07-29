<?php

namespace App\Http\Livewire\Dashboard;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

use Livewire\Component;
use App\Models\User;

use Carbon\Carbon;

class Index extends Component
{

    public $users;

    /**
     * delete action listener
     */
    protected $listeners = [];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name'  => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->users = User::orderBy('created_at','DESC')
        ->take(config('app.paginate'))
        ->get();
    }

    public function render()
    {
        $chart_options = [
            'chart_type'        => 'bar',
            'group_by_period'   => 'month',
            'group_by_field'    => 'created_at',
            'report_type'       => 'group_by_date',
            'chart_title'       => 'Users by Month',
            'model'             => 'App\Models\User',
        ];

        $users_chart = new LaravelChart($chart_options);

        return view('livewire.dashboard.index',compact('users_chart'))
        ->extends('layouts.app')
        ->section('content');
    }

}
