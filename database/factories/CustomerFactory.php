<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $today = Carbon::now();

        return [
            'name'                 =>  'Customer '.fake()->name(),
            'phone'                =>  '+254700007'.fake()->randomNumber(3, true),
            'email'                =>   fake()->unique()->safeEmail(),
            'address'              =>   'N/a',
            'type_id'              =>   1,
            'status_id'            =>   1,
            'id_number'            =>   '36958'.fake()->randomNumber(3, true),
            'notification_type_id' =>   1,
            'opening_balance'      =>   fake()->randomFloat(0, 0, 10000),
            'created_at'           =>   $today,
        ];
    }
}
