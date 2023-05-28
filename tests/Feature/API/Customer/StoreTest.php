<?php

namespace Tests\Feature\API\Customer;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_has()
    {
        $this->postJson('api/customers')
            ->assertBadRequest();
    }

    public function test_create()
    {
        $customer = Customer::factory()->make();
        $data = $customer->toArray();
        $this
            ->postJson('api/customers', $data)
            ->assertCreated();

        $this->assertDatabaseCount(Customer::class, 1);
        $this->assertDatabaseHas(Customer::class, $data);
    }
}
