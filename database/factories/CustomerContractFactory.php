<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\CustomerContract;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerContract>
 */
class CustomerContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerContract::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $today = Carbon::now();
        return [
            'name'                 =>   'Assignment '.fake()->randomNumber(2, true),
            'customer_id'          =>   fake()->randomNumber(1,1,10),
            'cost_per_guard'       =>   fake()->randomFloat(2, 15000, 30000),
            'daily_rate'           =>   fake()->randomFloat(2, 8000, 13500),
            'number_of_guards'     =>   fake()->randomNumber(1, true),
            'contact_phone'        =>   '+254700007'.fake()->randomNumber(3, true),
            'contact_person'       =>   fake()->name(),
            'zone_id'              =>   1,
            'tax_type_id'          =>   1,
            'payroll_priority_id'  =>   1,
            'agreement_date'       =>   $today->copy()->subYear(2),
            'end_date'             =>   $today->copy()->addYear(10),
            'active'               =>   1,
            'signed'               =>   1,
        ];
    }
}
