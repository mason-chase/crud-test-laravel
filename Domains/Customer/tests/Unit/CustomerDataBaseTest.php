<?php

namespace Domains\Customer\Tests\Unit;

use Domains\Customer\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerDataBaseTest extends TestCase
{
    use RefreshDatabase;
    public function test_customer_model_exists(): void
    {
        $customer = Customer::factory()->create();
        $this->assertModelExists($customer);
    }

    public function test_customer_table_has_inserted_record(): void
    {
        $customer = Customer::factory()->create();
        $this->assertDatabaseHas('customers', [
            'email' => $customer->email,
        ]);
    }

    public function test_customers_count_is_accurate():void
    {
        $numOfCustomers = random_int(5,25);
        $customer = Customer::factory($numOfCustomers)->create();
        $this->assertDatabaseCount('customers', $numOfCustomers);
    }
}
