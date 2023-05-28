<?php

namespace Domains\Customer\Listeners;

use Domains\Customer\Events\IndexEvent;
use Domains\Customer\Repositories\Interfaces\CustomerRepositoryInterface;

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
