<?php

namespace Tests\Feature;

use App\Models\Customer;
use Symfony\Component\HttpFoundation\Response;

it('can get list of customers', function () {
    $randomNum = random_int(1, 20);
    Customer::factory()->count($randomNum)->create();

    $response = $this->getJson(route(name: 'customers.index'));

    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonCount($randomNum, 'data');
    $response->assertJsonStructure([
        'data' => [
            [
                'id',
                'firstName',
                'dateOfBirth',
                'lastName',
                'email',
                'phoneNumber',
                'bankAccountNumber',
            ],
        ],
    ]);
});
