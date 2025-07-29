<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user_1 = User::create([
            'name'          =>  'System Admin',
            'email'         =>  'info@admin.com',
            'phone'         =>  '0150123654',
            'password'      =>  'admin',
            'department_id' =>  1,
        ]);

        $user_2 = User::create([
            'name'          =>  'Sample User',
            'email'         =>  'example@gmail.com',
            'phone'         =>  '012345678',
            'password'      =>  123456,
            'department_id' =>  1,
        ]);

        $role = Role::create(['name'=> 'Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user_2->assignRole([$role->id]);

        $role2 = Role::create(['name'=> 'Super Admin']);
        $user_1->assignRole([$role2->id]);

    }
}
