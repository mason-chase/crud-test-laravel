<?php

namespace App\Jobs\Customer;

use App\Events\Customer\StoreEvent;
use App\Repositories\ICustomerRepository;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreJob
{
	use Dispatchable, InteractsWithQueue, SerializesModels;

	/** @var ICustomerRepository $customerRepository */
	var $customerRepository;

	/**
	 * Create a new job instance.
	 */
	public function __construct( public array $data )
	{
		$this->customerRepository = app()->make( ICustomerRepository::class );
	}

	/**
	 * Execute the job.
	 */
	public function handle()
	{
		$result = $this->customerRepository->createNewCustomer
		(
			$this->data[ 'firstName' ],
			$this->data[ 'lastName' ],
			$this->data[ 'dateOfBirth' ],
			$this->data[ 'phoneNumber' ],
			$this->data[ 'email' ],
			$this->data[ 'bankAccountNumber' ]
		);

		if ( $result )
		{
			event( new StoreEvent( $result ) );
		}

		return $result;
	}
}
