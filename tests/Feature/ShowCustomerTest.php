<?php

namespace Tests\Feature;

use App\Models\Customer;

it('can get one of customer', function () {
    $customer = Customer::factory()->create();

    $response = $this->getJson("/api/customers/{$customer->id}");

    $response->assertStatus(200);
    $response->assertJson([
        'id' => $customer->id,
        'firstName' => $customer->first_name,
        'dateOfBirth' => $customer->date_of_birth,
        'lastName' => $customer->last_name,
        'email' => $customer->email,
        'phoneNumber' => $customer->phone_number,
        'bankAccountNumber' => $customer->bank_account_number,
    ]);
});

it('failed to get a not valid customer', function () {
    $randomNum = random_int(1, 20);

    $response = $this->getJson("/api/customers/$randomNum");

    $response->assertStatus(404);
});
