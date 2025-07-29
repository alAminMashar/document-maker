<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Notify Theme
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    'theme' => env('NOTIFY_THEME', 'light'),

    /*
    |--------------------------------------------------------------------------
    | Notification timeout
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    'employee_rules' => [
        'emp_first_name'           => 'required|min:2',
        'emp_second_name'          => 'required|min:2',
        'email'                    => 'unique:employees',
        'phone'                    => 'unique:employees|min:12|max:13',
        'id_number'                => 'required|unique:employees|min:7|max:9',
        'nssf'                     => 'required|unique:employees|min:9|max:15',
        'nhif'                     => 'unique:employees|max:13',
        'kra_pin'                  => 'required|unique:employees|min:9|max:15',
        'serial_number'            => 'unique:employees|min:3|max:15',
        'emp_position_id'          => 'required',
        'emp_department_id'        => 'required',
        'emp_gender_id'            => 'required',
        'emp_dob'                  => 'required',
        'emp_date_of_employment'   => 'required',
        'emp_employment_type_id'   => 'required',
        'emp_payment_method_id'    => 'required',
        'emp_salary'               => 'numeric',
        'branch_id'                => 'required'
    ],


    'kin_rules' => [
        'kin_first_name'            => '',
        'kin_second_name'           => '',
        'kin_phone'                 => '',
        'kin_relation_type_id'      => '',
    ],

];
