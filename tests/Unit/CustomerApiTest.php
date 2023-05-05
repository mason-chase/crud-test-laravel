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

    // test store ======================================================
    public function test_guests_cant_store_customer(): void
    {
        $response = $this->postJson(route('customer.store'), []);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_store_empty_customer(): void
    {
        $this->actingAs(User::factory()->create());
        $response = $this->postJson(route('customer.store'), []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_store_customer_first_name_validation(): void
    {
        $this->actingAs(User::factory()->create());
        $customerData = [
            'first_name' => 'Ali Asghar',
            'last_name' => 'Tofighian',
            'date_of_birth' => '2008-02-23',
            'phone_number' => '+1 256 886 8178',
            'email' => 'tofighatwork@gmail.com',
            'bank_account_number' => '6037997211111111',
        ];
        $garbageData = $customerData;

        // 1) numeric name provided
        $garbageData["first_name"] = 123;
        $response = $this->postJson(route('customer.store'), $garbageData);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('errors.first_name')->etc()
        );
        // 2) long name provided
        $garbageData["first_name"] = 'Ali Asghar Ali Asghar Ali Asghar Ali Asghar Ali Asghar Ali Asghar';
        $response = $this->postJson(route('customer.store'), $garbageData);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('errors.first_name')->etc()
        );
        // last name is omitted (no need to check)
    }

    public function test_store_customer_email_validation(): void
    {
        $this->actingAs(User::factory()->create());
        $customerData = [
            'first_name' => 'Ali Asghar',
            'last_name' => 'Tofighian',
            'date_of_birth' => '2008-02-23',
            'phone_number' => '+1 256 886 8178',
            'email' => 'tofighatwork@gmail.com',
            'bank_account_number' => '6037997211111111',
        ];
        Customer::create($customerData);
        //  the same email should not be accepted
        $response = $this->postJson(route('customer.store'), $customerData);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('errors.email')->etc()
        );
    }

    public function test_store_customer_successfully(): void
    {
        $this->actingAs(User::factory()->create());
        $customerData = [
            'first_name' => 'Ali Asghar',
            'last_name' => 'Tofighian',
            'date_of_birth' => '2008-02-23',
            'phone_number' => '+1 256 886 8178',
            'email' => 'tofighatwork@gmail.com',
            'bank_account_number' => '6037997211111111',
        ];
        $response = $this->postJson(route('customer.store'), $customerData);
        $response->assertStatus(Response::HTTP_CREATED);
        // check for correct localization
        $response->assertJsonPath('message', __('messages.customers.success.stored'));
    }

    // test update ======================================================
    public function test_update_on_invalid_id(): void
    {
        $this->actingAs(User::factory()->create());
        $customerData = [
            'first_name' => 'Ali Asghar',
            'last_name' => 'Tofighian',
            'date_of_birth' => '2008-02-23',
            'phone_number' => '+1 256 886 8178',
            'email' => 'tofighatwork@gmail.com',
            'bank_account_number' => '6037997211111111',
        ];
        $garbageIds = [-1, 0, 1]; // when db is empty non should work
        foreach ($garbageIds as $id) {
            $response = $this->putJson(route('customer.update', ['id'=> $id]), $customerData);
            $response->assertJsonPath('errors.id', [__('validation.exists', ['attribute'=> 'id'])]);
        }
    }

    public function test_customer_retakes_his_email(): void
    {
        $this->actingAs(User::factory()->create());
        $customerData = [
            'first_name' => 'Ali Asghar',
            'last_name' => 'Tofighian',
            'date_of_birth' => '2008-02-23',
            'phone_number' => '+1 256 886 8178',
            'email' => 'tofighatwork@gmail.com',
            'bank_account_number' => '6037997211111111',
        ];
        $customer = Customer::create($customerData);
        $response = $this->putJson(route('customer.update', ['id'=> $customer->id]), $customerData);
        $response->assertStatus(Response::HTTP_ACCEPTED);
    }
    public function test_taking_existing_email(): void
    {
        $this->actingAs(User::factory()->create());
        $customerDataOne = [
            'first_name' => 'Ali Asghar',
            'last_name' => 'Tofighian',
            'date_of_birth' => '2008-02-23',
            'phone_number' => '+1 256 886 8178',
            'email' => 'tofighatwork@gmail.com',
            'bank_account_number' => '6037997211111111',
        ];
        $customerDataTwo = [
            'first_name' => 'Ali',
            'last_name' => 'Tofigh',
            'date_of_birth' => '2008-02-23',
            'phone_number' => '+1 356 886 8178',
            'email' => 'tofigh@gmail.com',
            'bank_account_number' => '6037997211111112',
        ];
        Customer::create($customerDataOne);
        $customerTwo = Customer::create($customerDataTwo);
        // customer two tries to get customer one's email
        $response = $this->putJson(route('customer.update', ['id'=> $customerTwo->id]), $customerDataOne);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonPath('errors.email', [__('validation.unique', ['attribute'=> 'email'])]);
    }
    /**
     * @TODO: Test the compound unique key ASAP
     */
    public function todo_test_combination_of_firstname_lastname_and_birthday() : void
    {
        $this->actingAs(User::factory()->create());
        $customerDataOne = [
            'first_name' => 'Ali Asghar',
            'last_name' => 'Tofighian',
            'date_of_birth' => '2008-02-23',
            'phone_number' => '+1 256 886 8178',
            'email' => 'tofighatwork@gmail.com',
            'bank_account_number' => '6037997211111111',
        ];
        $customerDataTwo = [
            'first_name' => 'Ali Asghar 1',
            'last_name' => 'Tofighian',
            'date_of_birth' => '2008-02-23',
            'phone_number' => '+98 56 886 8178',
            'email' => 'tofigh1@gmail.com',
            'bank_account_number' => '6037997233333333',
        ];

        $requestData = [
            'first_name' => 'Ali Asghar',
            'last_name' => 'Tofighian',
            'date_of_birth' => '2008-02-23',
            'phone_number' => '+97 56 886 8178',
            'email' => 'tofigh2@gmail.com',
            'bank_account_number' => '6037997244444444',
        ];

        $customerOne = Customer::create($customerDataOne);
        Customer::create($customerDataTwo);

        $response = $this->putJson(route('customer.update', ['id'=> $customerOne->id]), $requestData);
    }

    // test delete ======================================================
    public function test_delete_on_invalid_id(): void
    {
        $this->actingAs(User::factory()->create());
        $garbageIds = [-1, 0, 1]; // when db is empty non should work
        foreach ($garbageIds as $id) {
            $response = $this->deleteJson(route('customer.delete', ['id'=> $id]));
            $response->assertJsonPath('errors.id', [__('validation.exists', ['attribute'=> 'id'])]);
        }
    }

    public function test_delete_on_valid_id(): void
    {
        $this->actingAs(User::factory()->create());
        $customer = Customer::factory()->create();
        $response = $this->deleteJson(route('customer.delete', ['id'=> $customer->id]));
        $response->assertStatus(Response::HTTP_ACCEPTED);
        $response->assertJsonPath('message', __('messages.customers.success.deleted', ['id'=> $customer->id]));
    }
}
