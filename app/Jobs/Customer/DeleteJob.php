<?php

namespace App\Jobs\Customer;

use App\Events\Customer\DeleteEvent;
use App\Repositories\ICustomerRepository;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteJob
{
	use Dispatchable, InteractsWithQueue, SerializesModels;

	/** @var ICustomerRepository $customerRepository */
	var $customerRepository;

	/**
	 * Create a new job instance.
	 */
	public function __construct( public string $id )
	{
		$this->customerRepository = app()->make( ICustomerRepository::class );
	}

	/**
	 * Execute the job.
	 */
	public function handle()
	{
		$result = $this->customerRepository->findOrFail( $this->id )->delete();
		if ( $result )
		{
			event( new DeleteEvent( $this->id ) );
		}
		return $result;
	}
}
