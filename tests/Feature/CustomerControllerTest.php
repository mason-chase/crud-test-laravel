<?php

namespace Tests\Feature;

use App\Jobs\Customer\SingleJob;
use App\Models\Customer;
use Cassandra\Custom;
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

		$response->assertStatus( 201 );
	}

	public  function  test_index()
	{
		$response = $this->withHeaders(
			[
				'accept' => 'application/json',
			]
		)->get( '/api/v1/customer' );
		$response->assertJsonCount(1,"data");
	}

	public  function  test_single()
	{
		$id = Customer::first()->id;
		$response = $this->withHeaders(
			[
				'accept' => 'application/json',
			]
		)->get( '/api/v1/customer/'.$id );
		$response->assertJson(Customer::find($id)->toArray());
	}
}
