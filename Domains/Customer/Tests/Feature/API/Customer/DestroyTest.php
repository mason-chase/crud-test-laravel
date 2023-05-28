<?php

namespace Domains\Customer\Tests\Feature\API\Customer;

use Domains\Customer\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function test_destroy()
    {
        $customer = Customer::factory()->create();
        $this
            ->deleteJson('api/customers/'.$customer->id)
            ->assertOk();

        $this->assertDatabaseCount(Customer::class, 0);
    }
}
