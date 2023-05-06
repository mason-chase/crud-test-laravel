<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Src\Customer\Domain\Entities\CustomerModel;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateCustomerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_update_customer(): void
    {
        $customer = CustomerModel::factory()->create();

        $response = $this->patchJson(
            route('customers.update', ['customer' => $customer]),
            $customer->toArray()
        );

        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->hasAny(['message'])
        )
            ->assertJsonPath('message', 'Update customer successfully.')
            ->assertStatus(Response::HTTP_ACCEPTED);
    }

    public function test_update_not_exists_customer()
    {
        $customer = [
            'first_name' => 'Farshid',
            'last_name' => 'Sohrabiani',
            'date_of_birth' => '1992-03-05',
            'phone_number' => '+989163675575',
            'email' => 'email@gmail.com',
            'bank_account_number' => '123456789'
        ];

        $response = $this->patchJson(
            route('customers.update', ['customer' => 5]),
            $customer
        );

        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->hasAny(['message'])
        )
            ->assertJsonPath('message', 'No query results for model [Src\Customer\Domain\Entities\CustomerModel] 5')
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
