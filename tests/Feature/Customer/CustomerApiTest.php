<?php

namespace Tests\Feature\Customer;

use App\Models\Customer;
use App\Utilities\Text\TokenGenerator;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerApiTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     */
    public function test_ok_customers(): void
    {
        $response = $this->getJson('/api/customers');

        $response->assertStatus(200);

        $items = $response->json('data', []);

        foreach ($items as $item){
            $customer = Customer::query()->firstWhere('uuid', data_get($item, 'uuid'));

            $this->assertCustomer($customer, $item);
        }
    }

    /**
     * A basic feature test example.
     */
    public function test_ok_customer_on_store(): void
    {
        $response = $this->postJson('/api/customers', $this->getCustomerFakePayload());

        $response->assertStatus(201);

        $customerFind = Customer::query()->firstWhere('uuid', $response->json('data.uuid'));;

        $this->assertCustomer($customerFind, $response->json('data'));
    }

    /**
     * A basic feature test example.
     */
    public function test_fail_validation_customer_on_store(): void
    {
        $response = $this->postJson('/api/customers', [
            'email' => null
        ]);

        $response->assertStatus(422);
    }

    /**
     * A basic feature test example.
     */
    public function test_fail_validation_name_brith_date_exists_customer_on_store(): void
    {
        $customerCreate = $this->createCustomer();

        $payload = $this->getCustomerFakePayload();

        $payload['first_name'] = $customerCreate->first_name;
        $payload['last_name'] = $customerCreate->last_name;
        $payload['date_of_brith'] = $customerCreate->brith_of_date;

        $response = $this->postJson('/api/customers', $payload);

        $response->assertStatus(422);
    }

    /**
     * A basic feature test example.
     */
    public function test_ok_customer_on_update(): void
    {
        $customerCreate = $this->createCustomer();

        $response = $this->putJson('/api/customers/' . $customerCreate->uuid, $this->getCustomerFakePayload());

        $response->assertStatus(200);

        $customerFind = Customer::query()->firstWhere('uuid', $response->json('data.uuid'));;

        $this->assertCustomer($customerFind, $response->json('data'));
    }

    /**
     * A basic feature test example.
     */
    public function test_fail_validation_customer_on_update(): void
    {
        $customerCreate = $this->createCustomer();

        $response = $this->putJson('/api/customers/' . $customerCreate->uuid, [
            'email' => null
        ]);

        $response->assertStatus(422);
    }

    /**
     * A basic feature test example.
     */
    public function test_fail_validation_name_brith_date_exists_customer_on_update(): void
    {
        $customerCreate = $this->createCustomer();

        $customerCreate2 = $this->createCustomer();

        $payload = $this->getCustomerFakePayload();

        $payload['first_name'] = $customerCreate2->first_name;
        $payload['last_name'] = $customerCreate2->last_name;
        $payload['date_of_brith'] = $customerCreate2->brith_of_date;

        $response = $this->putJson('/api/customers/' . $customerCreate->uuid, $payload);

        $response->assertStatus(422);
    }

    /**
     * A basic feature test example.
     */
    public function test_not_found_customer_on_update(): void
    {
        $customerCreate = $this->createCustomer();

        $response = $this->putJson('/api/customers/' . $this->faker->uuid);

        $response->assertStatus(404);
    }

    /**
     * A basic feature test example.
     */
    public function test_ok_customer_on_show(): void
    {
        $customerCreate = $this->createCustomer();

        $response = $this->getJson('/api/customers/' . $customerCreate->uuid);

        $response->assertStatus(200);

        $customerFind = Customer::query()->firstWhere('uuid', $response->json('data.uuid'));;

        $this->assertCustomer($customerFind, $response->json('data'));
    }

    /**
     * A basic feature test example.
     */
    public function test_not_found_customer_on_show(): void
    {
        $customerCreate = $this->createCustomer();

        $response = $this->getJson('/api/customers/' . $this->faker->uuid);

        $response->assertStatus(404);
    }

    /**
     * A basic feature test example.
     */
    public function test_ok_customer_on_delete(): void
    {
        $customerCreate = $this->createCustomer();

        $response = $this->deleteJson('/api/customers/' . $customerCreate->uuid);

        $response->assertStatus(204);
    }

    /**
     * A basic feature test example.
     */
    public function test_not_found_customer_on_delete(): void
    {
        $customerCreate = $this->createCustomer();

        $response = $this->deleteJson('/api/customers/' . $this->faker->uuid);

        $response->assertStatus(404);
    }

    protected function assertCustomer(Customer $customer, array $item)
    {
        $this->assertModelExists($customer);

        $this->assertEquals($customer->first_name, data_get($item, 'first_name'));
        $this->assertEquals($customer->last_name, data_get($item, 'last_name'));
        $this->assertEquals($customer->email, data_get($item, 'email'));
        $this->assertEquals($customer->phone_number, data_get($item, 'phone_number'));
        $this->assertEquals($customer->date_of_brith, Carbon::parse(data_get($item, 'date_of_brith')));
        $this->assertEquals($customer->bank_account_number, data_get($item, 'bank_account_number'));
    }

    protected function createCustomer()
    {
        return Customer::factory()->create();
    }

    protected function getCustomerFakePayload()
    {
        return [
            'uuid' => $this->faker->uuid,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone_number' => '0912' . TokenGenerator::number(7),
            'date_of_brith' => $this->faker->date('Y-m-d'),
            'bank_account_number' => TokenGenerator::number(8),
        ];
    }
}
