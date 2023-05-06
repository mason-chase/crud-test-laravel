<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Src\Customer\Domain\Entities\CustomerModel;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class GetCustomersTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_not_exists_customer(): void
    {
        $response = $this->get(route('customers.show', ['customer' => 10]));

        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->hasAny(['message', 'data'])
        )
            ->assertJsonPath('message', 'No query results for model [Src\Customer\Domain\Entities\CustomerModel] 10')
            ->assertJsonPath('data', [])
            ->assertStatus(Response::HTTP_NOT_FOUND);

    }

    public function test_show_exists_customer(): void
    {
        $customer = CustomerModel::factory()->create();

        $this->postJson(route('customers.store'), $customer->toArray());

        $response = $this->get(route('customers.show', ['customer' => $customer]));

        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->hasAny(['message', 'data'])
        )
            ->assertJsonPath('message', 'Find customer successfully')
            ->assertJsonPath('data.id', $customer->id)
            ->assertJsonPath('data.first_name', $customer->first_name)
            ->assertJsonPath('data.last_name', $customer->last_name)
            ->assertJsonPath('data.date_of_birth', $customer->date_of_birth)
            ->assertJsonPath('data.phone_number', (int) $customer->phone_number)
            ->assertJsonPath('data.email', $customer->email)
            ->assertJsonPath('data.bank_account_number', (int)$customer->bank_account_number)
            ->assertStatus(Response::HTTP_OK);

    }

    public function test_get_customers_list(): void
    {
        CustomerModel::factory()->count(3)->create();

        $response = $this->get(route('customers.index'));

        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->has('data', 3)
        )
            ->assertStatus(Response::HTTP_OK);

    }
}
