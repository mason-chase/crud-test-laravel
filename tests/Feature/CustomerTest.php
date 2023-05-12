<?php

namespace Tests\Feature;

use App\Utility\ApiResponse;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Domains\Customer\Models\Customer;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function test_can_get_list_of_all_customers()
    {

        $this->withoutExceptionHandling();

        Customer::factory(10)->create();
        $response = $this->get('api/v1/customer');
        $response->assertStatus(ApiResponse::HTTP_OK);
    }

    /** @test */
    public function test_can_get_single_customer()
    {
        $customer = Customer::factory()->create();
        $response = $this->get('/api/v1/customer/' . $customer->id);
        $response->assertSee($customer->first_name)
            ->assertSee($customer->last_name);
    }

    /** @test */
    public function test_can_store_customer()
    {
        $data = [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'date_of_birth' => fake()->dateTimeBetween('-70 years', '-2 years')->format('Y-m-d'),
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->unique()->email(),
            'bank_account_number' => fake()->numerify('####-####-####-####'),
        ];
        $response = $this->call('post', route('customer.store'), $data);
        $response->assertSee(ApiResponse::SUCCESS)
            ->assertSee(ApiResponse::HTTP_OK);
    }

    /** @test */
    public function test_can_update_customer()
    {
        $data = [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'date_of_birth' => fake()->dateTimeBetween('-70 years', '-2 years')->format('Y-m-d'),
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->unique()->email(),
            'bank_account_number' => fake()->numerify('####-####-####-####'),
        ];
        $customer = Customer::factory()->create();

        $response = $this->call('put', route('customer.update', ['customer' => $customer->id]), $data);
        $response->assertSee(ApiResponse::SUCCESS)
            ->assertSee(ApiResponse::HTTP_OK);
    }

    /** @test */
    public function test_can_delete_customer()
    {
        $customer = Customer::factory()->create();
        $response = $this->call('delete', route('customer.destroy', ['customer' => $customer->id]));
        $response->assertNoContent();
    }
}
