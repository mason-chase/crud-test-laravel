<?php

namespace Tests\Feature\API\Customer;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_has()
    {
        $customer = Customer::factory()->create();
        $this->putJson('api/customers/'.$customer->id)
            ->assertUnprocessable();
    }

    public function test_update()
    {
        $customer = Customer::factory()->create();
        $data = Customer::factory()->make()->toArray();
        $this
            ->putJson('api/customers/'.$customer->id, $data)
            ->assertOk();

        $this->assertDatabaseCount(Customer::class, 1);
        $this->assertDatabaseHas(Customer::class, ['email' => $data['email']]);
    }
}
