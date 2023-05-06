<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Src\Customer\Domain\Entities\CustomerModel;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteCustomerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_delete_customer(): void
    {
        $customer = CustomerModel::factory()->create();

        $response = $this->delete(route('customers.destroy', ['customer' => $customer]));

        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->hasAny(['message'])
        )
            ->assertJsonPath('message', 'Delete customer successfully.')
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_delete_not_exists_customer(): void
    {

        $response = $this->delete(route('customers.destroy', ['customer' => 2]));


        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->hasAny(['message'])
        )
            ->assertJsonPath('message', 'No query results for model [Src\Customer\Domain\Entities\CustomerModel] 2')
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
