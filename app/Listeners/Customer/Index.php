<?php

namespace App\Listeners\Customer;

use App\Events\Customer\IndexEvent;
use App\Repositories\Interfaces\CustomerRepositoryInterface;

class Index
{
    public function __construct(protected CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle(IndexEvent $event)
    {
        return $this->customerRepository->allCustomers();
    }
}
