<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerStatementItem>
 */
class CustomerStatementItemFactory extends Factory
{
    protected $model = StatementItem::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
    */
    public function definition(): array
    {
        return [
            'customer_id' => null, // Set this in the test or via relationship
            'date'        => $this->faker->dateTimeBetween('-1 month', 'now'),
            'credit'      => $this->faker->randomElement([0, $this->faker->numberBetween(100, 1000)]),
            'debit'       => $this->faker->randomElement([0, $this->faker->numberBetween(100, 1000)]),
            'balance'     => 0, // Will be calculated in your job
        ];
    }
}
