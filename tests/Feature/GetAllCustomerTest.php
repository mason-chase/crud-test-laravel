<?php

namespace Tests\Feature;

use App\Models\Customer;

it('can get list of customers', function () {
    $randomNum = random_int(1, 20);
    Customer::factory()->count($randomNum)->create();

    $response = $this->getJson('/api/customers');

    $response->assertStatus(200);
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
