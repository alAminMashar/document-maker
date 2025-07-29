<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Customer;
use App\Models\CustomerStatementItem;
use App\Jobs\ProrateCustomerStatementItems;

class BalanceCustomerStatementJobTest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    public function it_correctly_balances_customer_statement_items()
    {
        if(env('APP_ENV')== 'local')
        {
            // Arrange: Create a customer with an opening balance
            $customer = Customer::factory()->create([
                'opening_balance' => 1000,
            ]);

            CustomerStatementItem::factory()->create([
                'customer_id' => $customer->id,
                'credit' => 500,
                'debit' => 0,
                'date' => now()->subDays(2),
            ]);

            CustomerStatementItem::factory()->create([
                'customer_id' => $customer->id,
                'credit' => 0,
                'debit' => 200,
                'date' => now()->subDay(),
            ]);

            // Act: Run the job
            // (new \App\Jobs\BalanceCustomerStatementJob($customer))->handle();
            (new ProrateCustomerStatementItems($customer))->handle();

            // Assert
            $items = $customer->fresh()->statementItems()->orderBy('date')->get();

            $this->assertEquals(1500, $items[0]->balance);
            $this->assertEquals(1300, $items[1]->balance);
            $this->assertEquals(1300, $customer->fresh()->current_balance);
        }
    }
}

