<?php

namespace App\Helpers\Filters;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use App\Models\Employee as Employee;
use App\Models\Kin as Kin;
use App\Models\Document as Documents;
use App\Models\DocumentType as DocumentTypes;
use App\Models\EmployeePosition as Positions;
use App\Models\EmployeeStatus as Statuses;
use App\Models\RelationshipType as Relations;
use App\Models\Department as Departments;
use App\Models\Gender as Genders;
use App\Models\Bank as Banks;
use App\Models\BankAccount as BankAccounts;
use App\Models\PaymentMethod as PaymentMethods;
use App\Models\EmploymentType as EmploymentTypes;
use App\Models\Salary as Salary;
use App\Models\Branch as Branch;

//Deployment Includes
use App\Models\CustomerContract as Contracts;
use App\Models\EmployeeDeployment as Deployments;
use App\Models\Employee as Employees;
use App\Models\EmployeeShift as Shifts;
use Illuminate\Http\Request;

class EmployeeFilter
{

    //filter variables
    protected $query;
    public $filter_description, $result_count, $active = true, $filter = false;

    //Custom fields
    public $filter_customer;


    public function clearFilter(){
        $this->filter               =   false;
        $this->active               =   true;
        $this->query                =   '';
        $this->result_count         =   0;
        $this->filter_description   =   '';

        $this->filter_customer      =   '';
    }

    public function updateFilter()
    {
        //Activate Filter
        $this->filter = true;
        $this->render();

    }

    public function filter()
    {

        $this->filter_description   =   "";
        $this->result_count         =   0;
        $customer                   =   $this->filter_customer;
        $active                     =   $this->active;

        $desc = "Showing filtered results for ";

        $query = Employee::query();

        $query->where('slug','like','%'.$this->search.'%');

        if($customer != '') {
            $query->where('customer_id',$customer);
            $customer     =   Customer::find($this->filter_customer);
            $desc   =   $desc.$customer['name']." customer, ";
        }

        $query->where('active',$active);

        $active_description = $active?"active.":"inactive";
        $desc   =   $desc.$active_description;

        //Set Query
        $this->query = $query;
        //Write description
        $this->filter_description = $desc;
        //Result counter
        $this->result_count = $query->count();

        return $query;

    }

    /**
     * Write code on Method
     */
    public function render()
    {

        $employeed = $this->filter();
        $employeed = $employeed->orderBy('created_at','DESC')
        ->paginate(config('app.paginate'));

        return view('livewire.employee.index',['employeed'=> $employeed])
        ->extends('layouts.app')
        ->section('content');

    }
}

// @if ($filter)
// <br>
// <small class="text-secondary">
// <b class="text-muteds">({{ number_format($result_count) . ' results' }})</b>
// {{ $filter_description }}
// </small>
// @endif
