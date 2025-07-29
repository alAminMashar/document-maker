<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Permission::create([
            'name'  =>  'login'
        ]);

        Permission::create([
            'name'  =>  'dashboard'
        ]);

        Permission::create([
            'name'  =>  'home'
        ]);

        Permission::create([
            'name'  =>  'register'
        ]);

        Permission::create([
            'name'  =>  'logout'
        ]);

        Permission::create([
            'name'  =>  'profile'
        ]);

        Permission::create([
            'name'  =>  'roles'
        ]);

        Permission::create([
            'name'  =>  'permissions'
        ]);

        Permission::create([
            'name'  =>  'taxes.index'
        ]);

        Permission::create([
            'name'  =>  'banks.index'
        ]);

        Permission::create([
            'name'  =>  'departments.index'
        ]);

        Permission::create([
            'name'  =>  'positions.index'
        ]);

        Permission::create([
            'name'  =>  'shifts.index'
        ]);

        Permission::create([
            'name'  =>  'relationships.index'
        ]);

        Permission::create([
            'name'  =>  'document-types.index'
        ]);

        Permission::create([
            'name'  =>  'customer-types.index'
        ]);

        Permission::create([
            'name'  =>  'occurrence-types.index'
        ]);

        Permission::create([
            'name'  =>  'users'
        ]);

        Permission::create([
            'name'  =>  'employee.show'
        ]);

        Permission::create([
            'name'  =>  'employee.index'
        ]);

        Permission::create([
            'name'  =>  'inventory.show'
        ]);

        Permission::create([
            'name'  =>  'inventory.index'
        ]);

        Permission::create([
            'name'  =>  'gear.show'
        ]);

        Permission::create([
            'name'  =>  'gear.index'
        ]);

        Permission::create([
            'name'  =>  'supplier.show'
        ]);

        Permission::create([
            'name'  =>  'supplier.index'
        ]);

        Permission::create([
            'name'  =>  'customer.show'
        ]);

        Permission::create([
            'name'  =>  'customer.index'
        ]);

        Permission::create([
            'name'  =>  'customer-contract.show'
        ]);

        Permission::create([
            'name'  =>  'customer-contract.index'
        ]);

        Permission::create([
            'name'  =>  'employee-deployment.show'
        ]);

        Permission::create([
            'name'  =>  'employee-deployment.index'
        ]);

        Permission::create([
            'name'  =>  'occurrence.show'
        ]);

        Permission::create([
            'name'  =>  'occurrence.index'
        ]);

        Permission::create([
            'name'  =>  'deduction-type.show'
        ]);

        Permission::create([
            'name'  =>  'deduction-type.index'
        ]);

        Permission::create([
            'name'  =>  'position-bonus.show'
        ]);

        Permission::create([
            'name'  =>  'position-bonus.index'
        ]);

        Permission::create([
            'name'  =>  'salary-advance.show'
        ]);

        Permission::create([
            'name'  =>  'salary-advance.index'
        ]);

        Permission::create([
            'name'  =>  'payroll.show'
        ]);

        Permission::create([
            'name'  =>  'payroll.index'
        ]);

        Permission::create([
            'name'  =>  'customer-invoice.show'
        ]);

        Permission::create([
            'name'  =>  'customer-invoice.index'
        ]);

        Permission::create([
            'name'  =>  'customer-invoice.print'
        ]);

    }
}
