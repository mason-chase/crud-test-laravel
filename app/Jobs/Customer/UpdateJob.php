<?php

namespace App\Jobs\Customer;

use App\Events\Customer\UpdateEvent;
use App\Repositories\ICustomerRepository;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateJob
{
	use Dispatchable, InteractsWithQueue, SerializesModels;

	/** @var ICustomerRepository $customerRepository */
	var $customerRepository;

	/**
	 * Create a new job instance.
	 */
	public function __construct( public int $id, public array $data )
	{
		$this->customerRepository = app()->make( ICustomerRepository::class );
	}

	/**
	 * Execute the job.
	 */
	public function handle()
	{
		$result = $this->customerRepository->updateById
		(
			$this->id,
			$this->data
		);

		if ( $result )
		{
			event( new UpdateEvent( $this->id, $this->data ) );
		}
		return $result;

	}
}
