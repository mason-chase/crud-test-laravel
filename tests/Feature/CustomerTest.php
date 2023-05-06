<?php

namespace Tests\Feature;

use App\Domain\Customer\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    const BASE_API_PREFIX = '/api/customers';

    /**
     * test for get list of customers as json
     */
    public function test_get_list_of_customers(): void
    {
        Customer::factory()->count(2)->create();

        $response = $this->get(self::BASE_API_PREFIX);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    Customer::COL_UUID,
                    Customer::COL_FIRST_NAME,
                    Customer::COL_LAST_NAME,
                    Customer::COL_EMAIL,
                    Customer::COL_PHONE_NUMBER,
                    Customer::COL_DATE_OF_BIRTH,
                    Customer::COL_BACK_ACCOUNT_NUMBER,
                    Customer::CREATED_AT,
                    Customer::UPDATED_AT,
                ]
            ]
        ]);
        $response->assertJson([
            'data' => Customer::all()->toArray()
        ]);
        $response->assertJsonCount(2, 'data');
        $response->assertStatus(200);
    }

    /**
     * @store_test
     * test customer with valid data can be store
     */
    public function test_customer_with_valid_data_can_be_store(): void
    {
        $postData = [
            'email' => $this->faker->email,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date(),
            'phone_number' => $this->faker->e164PhoneNumber,
            'bank_account_number' => $this->faker->bankAccountNumber,
        ];

        $response = $this->post(self::BASE_API_PREFIX, $postData);

        $response->assertOk();
        $this->assertDatabaseHas(Customer::TABLE_NAME, $postData);
    }

    /**
     * @store_test
     * test customer with invalid data can not be store
     */
    public function test_customer_with_invalid_data_can_not_be_store(): void
    {
        $response = $this->post(self::BASE_API_PREFIX, [
            'email' => $this->faker->name,
            'first_name' => null,
            'last_name' => null,
            'date_of_birth' => '19999-01-123',
            'phone_number' => $this->faker->randomDigit(),
            'bank_account_number' => '111111',
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function test_customer_requires_a_valid_email()
    {
        $data = [
            'email' => 'not-a-valid-email',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'date_of_birth' => '1985-01-01',
            'phone_number' => '555-1234',
            'bank_account_number' => '1234567890',
        ];

        $response = $this->post(self::BASE_API_PREFIX, $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('email');
        $this->assertDatabaseMissing('customers', $data);
    }

    /** @test */
    public function test_customer_requires_a_unique_email()
    {
        $customer = Customer::factory()->create();

        $data = [
            'email' => $customer->email, // Use an existing email address
            'first_name' => 'John',
            'last_name' => 'Doe',
            'date_of_birth' => '1985-01-01',
            'phone_number' => '555-1234',
            'bank_account_number' => '1234567890',
        ];

        $response = $this->post(self::BASE_API_PREFIX, $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('email');
        $this->assertDatabaseMissing('customers', $data);
    }

    /** @test */
    public function test_customer_requires_a_unique_first_name_for_given_last_name_and_date_of_birth()
    {
        $customer = Customer::factory()->create();

        $data = [
            'email' => 'john.doe@example.com',
            'first_name' => $customer->first_name, // Use an existing first name
            'last_name' => $customer->last_name,
            'date_of_birth' => $customer->date_of_birth,
            'phone_number' => $this->faker->e164PhoneNumber,
            'bank_account_number' => '1234567890',
        ];

        $response = $this->post(self::BASE_API_PREFIX, $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('first_name');
        $response->assertJsonValidationErrors('last_name');
        $response->assertJsonValidationErrors('date_of_birth');
        $this->assertDatabaseMissing('customers', $data);
    }

    /**
     * @show_test
     * test customer should be unique on firstname lastname and date of birth and unique email too
     */
    public function test_show_single_customer_by_valid_and_invalid_uuid(): void
    {
        $uuid = Customer::factory()->create()->uuid;
        //add by factory with save
        $response = $this->get(self::BASE_API_PREFIX.'/'.$uuid);
        $response->assertStatus(200);

        $fakeUuid = '1111111111111';
        //add by factory with save
        $response = $this->get(self::BASE_API_PREFIX.'/'.$fakeUuid);
        $response->assertStatus(404);
    }

    /**
     * @update_test
     * test customer should update by valid data
     */
    public function test_customer_should_update_by_valid_data(): void
    {
        $customer = Customer::factory()->create();

        $data = [
            'email' => 'new.email@example.com',
            'first_name' => 'New',
            'last_name' => 'Name',
            'date_of_birth' => '1985-01-01',
            'phone_number' => $this->faker->e164PhoneNumber,
            'bank_account_number' => '1234567890',
        ];

        $response = $this->put(self::BASE_API_PREFIX.'/' . $customer->uuid, $data);

        $response->assertOk();

        $this->assertDatabaseHas('customers', [
            'uuid' => $customer->uuid,
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'date_of_birth' => $data['date_of_birth'],
            'phone_number' => $data['phone_number'],
            'bank_account_number' => $data['bank_account_number'],
        ]);
    }

    /**
     * @update_test
     * test customer cant update by invalid data such as check unique and invalidate data for.
     */
    public function test_customer_cant_update_by_invalid_data(): void
    {
        $customer = Customer::factory()->create();

        $data = [
            'email' => 'invalid email',
            'first_name' => '',
            'last_name' => '',
            'date_of_birth' => '2s022-05-06',
            'phone_number' => 'invalid phone',
            'bank_account_number' => 'not numeric',
        ];

        $response = $this->put(self::BASE_API_PREFIX.'/' . $customer->uuid, $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors([
            'email',
            'first_name',
            'last_name',
            'date_of_birth',
            'phone_number',
            'bank_account_number',
        ]);

        $this->assertDatabaseMissing('customers', [
            'uuid' => $customer->uuid,
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'date_of_birth' => $data['date_of_birth'],
            'phone_number' => $data['phone_number'],
            'bank_account_number' => $data['bank_account_number'],
        ]);
    }



    /**
     * @delete_test
     * test customer delete test. delete id exists, not fount if it not exists.
     */
    public function test_customer_delete(): void
    {
        $customer = Customer::factory()->create();
        $this->assertDatabaseHas(Customer::COL_UUID, [
            'uuid' => $customer->uuid,
        ]);
        //add by factory with save
        $response = $this->delete(self::BASE_API_PREFIX.'/'.$customer->uuid);
        $response->assertSuccessful();
        $this->assertDatabaseMissing(Customer::TABLE_NAME, [
            'uuid' => $customer->uuid,
        ]);

        $fakeUuid = '1111111111111';
        //add by factory with save
        $response = $this->get(self::BASE_API_PREFIX.'/'.$fakeUuid);
        $response->assertStatus(404);
    }
}
