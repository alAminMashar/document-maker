<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Employee;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $name = explode(" ", fake()->name());

        $slug = Str::slug($name[0].' '.$name[1], '-');

        $today = Carbon::now();

        $first_name   = isset($name[0])?$name[0]:'';
        $second_name  = isset($name[1])?$name[1]:'';
        $other_name   = isset($name[2])?$name[2]:'';

        return [
            'slug'                 => $slug,
            'first_name'           => $first_name,
            'second_name'          => $second_name,
            'other_name'           => $other_name,
            'dob'                  => $today,
            'gender_id'            => 1,
            'phone'                => '+254799147'.fake()->randomNumber(3, true),
            'email'                =>   fake()->unique()->safeEmail(),
            'id_number'            => '36958'.fake()->randomNumber(3, true),
            'nssf'                 => '5826931'.fake()->randomNumber(3, true),
            'kra_pin'              => 'PO5826931'.fake()->randomNumber(3, true),
            'position_id'          => 1,
            'department_id'        => 5,
            'date_of_employment'   => $today,
            'employment_type_id'   => 1,
            'payment_method_id'    => 5,
            'shift_id'             => 1,
            'status_id'            => 3,
            'published'            => 1,
            'created_at'           => $today,
        ];
    }
}
