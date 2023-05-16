<?php

namespace Tests\Feature;

use App\Models\Customer;
use Symfony\Component\HttpFoundation\Response;

it('can delete a customer', function () {
    $oldCustomer = Customer::factory()->create();

    $response = $this->deleteJson(route(name: 'customers.delete', parameters: $oldCustomer->id));

    $response->assertStatus(Response::HTTP_ACCEPTED);
    $response->assertJson([]);
    $this->assertDatabaseMissing((new Customer())->getTable(), [
        'id' => $oldCustomer->id,
    ]);
});

it('failed to delete a not valid customer', function () {
    $randomNum = random_int(1, 20);

    $response = $this->deleteJson(route(name: 'customers.delete', parameters: $randomNum));

    $response->assertStatus(404);
});

