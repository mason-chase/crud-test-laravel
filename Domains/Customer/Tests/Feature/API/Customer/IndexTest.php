<?php

namespace Domains\Customer\Tests\Feature\API\Customer;

use Domains\Customer\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_has()
    {
        $this->getJson('api/customers')
            ->assertOk();
    }

    public function test_fetch()
    {
        Customer::factory(5)->create();
        $responseStructure = [
            'data' => [
                [
                    'id',
                    'first_name',
                    'last_name',
                    'date_of_birth',
                    'phone_number',
                    'email',
                    'bank_account_number',
                ],
            ],
        ];
        $this
            ->getJson('api/customers')
            ->assertJsonStructure($responseStructure)
            ->assertJsonCount(5, 'data')
            ->assertOk();
    }
}
