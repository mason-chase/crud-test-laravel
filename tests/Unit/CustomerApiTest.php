<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CustomerApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_customers_list_endpoint_availabe_only_for_logged_in_users(): void
    {
        $response = $this->getJson(route('customers'));
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->actingAs(User::factory()->create());
        $response = $this->getJson(route('customers'));
        $response->assertStatus(Response::HTTP_OK);
    }
    public function test_general_json_structure(): void
    {
        $this->actingAs(User::factory()->create());
        $response = $this->getJson(route('customers'));

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->hasAll(['items', 'message', 'errors'])
        );
    }

    public function test_customers_count(): void
    {
        $this->actingAs(User::factory()->create());
        $response = $this->getJson(route('customers'));
        $response->assertJsonCount(0, 'items');

        $numOfCustomers = random_int(5,25);
        Customer::factory($numOfCustomers)->create();
        $response = $this->getJson(route('customers'));
        $response->assertJsonCount($numOfCustomers, 'items');
    }
}
