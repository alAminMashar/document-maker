<?php

namespace App\Imports;

use App\Models\User;

// use App\Models\Employee;
// use App\Models\CustomerContract as Assignment;
// use App\Models\EmployeeDeployment as Deployment;
// use Illuminate\Support\Str;
// use Carbon\Carbon;


use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {

        return new User([
            'name'          =>  $row[1],
            'email'         =>  $row[2],
            'phone'         =>  $row[3],
            'department_id' =>  $row[4],
            'password'      =>  $row[5],
            'created_at'    =>  $row[6],
            'updated_at'    =>  $row[7],
        ]);

        // $today = Carbon::now();
        // $employee = Employee::whereIdNumber($row[0])->first();
        // $contract = Assignment::find($row[1]);

        // if($employee){
        //     $slug = $employee->name().'-'.$contract->name.'-'.$contract->customer['name'];
        //     $slug = Str::slug($slug, '-');

        //     $deployment = Deployment::create([
        //         'slug'                      => $slug,
        //         'customer_contract_id'      => $row[1],
        //         'payroll_priority_id'       => $contract->payroll_priority_id,
        //         'employee_id'               => $employee->id,
        //         'deployment_date'           => $today,
        //         'end_date'                  => $contract->end_date,
        //         'reliever_scheduled'        => 0,
        //         'status'                    => 1,
        //         'reason'                    => 'N/A',
        //         'published'                 => 1,
        //     ]);
        // }


    }

}
