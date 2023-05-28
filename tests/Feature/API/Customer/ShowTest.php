<?php

namespace Tests\Feature\API\Customer;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch()
    {
        $customer = Customer::factory()->create();
        $responseStructure = [
            'id',
            'first_name',
            'last_name',
            'date_of_birth',
            'phone_number',
            'email',
            'bank_account_number',
        ];
        $this
            ->getJson('api/customers/'.$customer->id)
            ->assertJsonStructure($responseStructure)
            ->assertOk();
    }
}
