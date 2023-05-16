<?php

namespace Tests\Feature;


use App\Domains\Customer\Domain\Model\CustomerModel;

it('can get list of customers', function () {
    $randomNum = random_int(1, 20);
    CustomerModel::factory()->count($randomNum)->create();
    $response = $this->get('/customers');

    $response->assertStatus(200);

    $response->assertJsonCount($randomNum, 'data');
});

it('can get a customer', function () {
    $customer = CustomerModel::factory()->create();

    $response = $this->get("/customers/$customer->id" . $customer->id);

    $response->assertStatus(200);
    $response->assert($customer->name);
});

it('can create a customer', function () {
    $newCustomer = CustomerModel::factory()->make();
    $data = [
        'name' => $newCustomer->name,
        'email' => $newCustomer->email,
        'phone' => $newCustomer->phone,
    ];

    $response = $this->put("/customers", $data);

    $response->assertStatus(201);
    $this->assertDatabaseHas('customers', $data);
});

it('can update a customer', function () {
    $oldCustomer = CustomerModel::factory()->create();
    $newCustomer = CustomerModel::factory()->make();
    $data = [
        'name' => $newCustomer->name,
        'email' => $newCustomer->email,
        'phone' => $newCustomer->phone,
    ];

    $response = $this->put("/customers/$oldCustomer->id", $data);

    $response->assertStatus(202);
    $this->assertDatabaseHas('customers', $data);
});

it('can delete a customer', function () {
    $customer = CustomerModel::factory()->create();

    $response = $this->delete("/customers/$customer->id");

    $response->assertStatus(202);
    $this->assertDeleted('customers', ['id' => $this->customer->id]);
});
