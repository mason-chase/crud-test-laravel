<?php

namespace App\Jobs\Customer;

use App\Repositories\ICustomerRepository;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SingleJob
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

	/** @var ICustomerRepository $customerRepository */
	var $customerRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $id)
    {
        $this->customerRepository = app()->make(ICustomerRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->customerRepository->findOrFail($this->id);
    }
}
