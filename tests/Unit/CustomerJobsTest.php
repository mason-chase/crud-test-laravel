<?php

namespace Tests\Unit;

use App\Jobs\Customer\StoreJob;
use App\Models\Customer;
use Database\Factories\CustomerFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CustomerJobsTest extends TestCase
{
	use DatabaseTransactions;

	/**
	 * A basic unit test example.
	 */
	public function test_store_job(): void
	{
		$customerData = ( new ( CustomerFactory::class )() )->definition();
		dispatch_sync( new StoreJob( $customerData ) );
		$this->assertDatabaseHas( Customer::class, $customerData );
	}
}
