<?php

namespace Tests\Unit;

use App\Jobs\Customer\DeleteJob;
use App\Jobs\Customer\IndexJob;
use App\Jobs\Customer\SingleJob;
use App\Jobs\Customer\StoreJob;
use App\Jobs\Customer\UpdateJob;
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

	public function test_index_job(): void
	{
		$total = rand( 1, 5 );
		for ( $i = 0; $i < $total; $i++ )
		{
			$customerData = ( new ( CustomerFactory::class )() )->definition();
			dispatch_sync( new StoreJob( $customerData ) );
		}
		$index = dispatch_sync( new IndexJob() );
		$this->assertCount( $total, $index );
	}

	public function test_single_job(): void
	{
		$customerData = ( new ( CustomerFactory::class )() )->definition();
		dispatch_sync( new StoreJob( $customerData ) );
		$customer = Customer::first();
		$single = dispatch_sync( new SingleJob($customer->id) );
		$this->assertEquals($single,$customer);
	}
	public function test_delete_job(): void
	{
		$customerData = ( new ( CustomerFactory::class )() )->definition();
		dispatch_sync( new StoreJob( $customerData ) );
		$customer = clone Customer::first();
		$single = dispatch_sync( new DeleteJob($customer->id) );
		$this->assertDatabaseCount('customers',0);
	}

	public function test_update_job(): void
	{
		$customerData = ( new ( CustomerFactory::class )() )->definition();
		dispatch_sync( new StoreJob( $customerData ) );
		$customer = Customer::first();
		$single = dispatch_sync( new SingleJob($customer->id) );
		$this->assertEquals($single,$customer);

		$customerData = ( new ( CustomerFactory::class )() )->definition();
		dispatch_sync( new UpdateJob($customer->id, $customerData ) );
		$customer = Customer::first();
		$single = dispatch_sync( new SingleJob($customer->id) );
		$this->assertEquals($single,$customer);

	}

}
