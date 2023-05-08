<?php

namespace Tests\Feature;

use App\Models\Customer;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
	/**
	 * A basic feature test example.
	 */
	public function test_store(): void
	{
		$data     = Customer::factory()->make()->toArray();
		$response = $this->withHeaders(
			[
				'accept' => 'application/json',
			]
		)->post( '/api/v1/customer', $data );
		$this->assertDatabaseHas( Customer::class, $data );

		$response->assertStatus( 200 );
	}
}
