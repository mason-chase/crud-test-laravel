<?php

namespace Tests\Unit;

use App\Jobs\Customer\StoreJob;
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
		$customer     = dispatch_sync( new StoreJob( $customerData ) );
		$cleanData    = $customer->toArray();
		unset( $cleanData[ 'id' ] );
		unset( $cleanData[ 'created_at' ] );
		unset( $cleanData[ 'updated_at' ] );
		$this->assertTrue( $cleanData == $customerData );
	}
}
