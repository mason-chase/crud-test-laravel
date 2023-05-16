<?php

namespace Tests\Feature;

use App\Models\Customer;
use Symfony\Component\HttpFoundation\Response;

it('can update a customer', function () {
    $oldCustomer = Customer::factory()->create();

    $newCustomer = Customer::factory()->make();
    $response = $this->putJson(route(name: 'customers.update', parameters: $oldCustomer->id), $newCustomer->toArray());

    $response->assertStatus(Response::HTTP_ACCEPTED);
    $response->assertJson([]);
    $this->assertDatabaseMissing((new Customer())->getTable(), [
        'id' => $oldCustomer->id,
        'first_name' => $oldCustomer->first_name,
        'date_of_birth' => $oldCustomer->date_of_birth,
        'last_name' => $oldCustomer->last_name,
        'email' => $oldCustomer->email,
        'phone_number' => $oldCustomer->phone_number,
        'bank_account_number' => $oldCustomer->bank_account_number,
    ]);
    $this->assertDatabaseHas((new Customer())->getTable(), [
        'id' => $oldCustomer->id,
        'first_name' => $newCustomer->first_name,
        'date_of_birth' => $newCustomer->date_of_birth,
        'last_name' => $newCustomer->last_name,
        'email' => $newCustomer->email,
        'phone_number' => $newCustomer->phone_number,
        'bank_account_number' => $newCustomer->bank_account_number,
    ]);
});

it('failed to update a not valid customer', function () {
    $oldCustomer = Customer::factory()->create();
    $randomNum = random_int($oldCustomer->id + 1, $oldCustomer->id + 20);
    $newCustomer = Customer::factory()->make();
    $response = $this->putJson(route(name: 'customers.update', parameters: $randomNum), $newCustomer->toArray());

    $response->assertStatus(404);
});

// TODO:: failed on validation test
