<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateCustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_customer(): void
    {
        $response = $this->postJson(
            route('customers.store'),
            [
                'first_name' => 'Farshid',
                'last_name' => 'Sohrabiani',
                'date_of_birth' => '1992-03-05',
                'phone_number' => '+989163675575',
                'email' => 'fsohrabi047@gmail.com',
                'bank_account_number' => '123456789'
            ]
        );

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_create_duplicate_customer(): void
    {
        $customerData = [
            'first_name' => 'Farshid',
            'last_name' => 'Sohrabiani',
            'date_of_birth' => '1992-03-05',
            'phone_number' => '+989163675575',
            'email' => 'fsohrvabi047@gmail.com',
            'bank_account_number' => '9465165156'
        ];

        $this->postJson(
            route('customers.store'),
            $customerData
        );

        $response = $this->postJson(
            route('customers.store'),
            $customerData
        );

        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->hasAny(['errors', 'message'])
        )
            ->assertJsonPath('errors.customer_exists.0', 'Customer exists!!')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_invalid_phone_number(): void
    {
        $response = $this->postJson(
            'api/customers',
            [
                'first_name' => 'Farshid',
                'last_name' => 'Sohrabiani',
                'date_of_birth' => '1992-03-05',
                'phone_number' => '+84848989163675575',
                'email' => 'fsohrabi047@gmail.com',
                'bank_account_number' => '123456789'
            ]
        );

        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->hasAny(['errors', 'message'])
        )
            ->assertJsonPath('errors.phone_number.0', 'Invalid phone number.')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_invalid_email(): void
    {
        $response = $this->postJson(
            'api/customers',
            [
                'first_name' => 'Farshid',
                'last_name' => 'Sohrabiani',
                'date_of_birth' => '1992-03-05',
                'phone_number' => '+989163675575',
                'email' => 'fsohrabi047',
                'bank_account_number' => '123456789'
            ]
        );


        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->hasAny(['errors', 'message'])
        )
            ->assertJsonPath('errors.email.0', 'The email field must be a valid email address.')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_duplicate_email(): void
    {
        $customerOneData = [
            'first_name' => 'Mohsen',
            'last_name' => 'Eskandary',
            'date_of_birth' => '1992-03-05',
            'phone_number' => '+989163675575',
            'email' => 'jondoe@gmail.com',
            'bank_account_number' => '9465165156'
        ];

        $this->postJson(
            route('customers.store'),
            $customerOneData
        );

        $customerTwoData = [
            'first_name' => 'Ali',
            'last_name' => 'Rezaee',
            'date_of_birth' => '1992-03-05',
            'phone_number' => '+989163675575',
            'email' => 'jondoe@gmail.com',
            'bank_account_number' => '9465165156'
        ];

        $response = $this->postJson(
            route('customers.store'),
            $customerTwoData
        );

        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->hasAny(['errors', 'message'])
        )
            ->assertJsonPath('errors.email.0', 'The email has already been taken.')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
