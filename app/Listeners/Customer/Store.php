<?php

namespace App\Listeners\Customer;

use App\Events\Customer\StoreEvent;
use App\Repositories\Interfaces\CustomerRepositoryInterface;

class Store
{
    public function __construct(protected CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle(StoreEvent $event)
    {
        return $this->customerRepository->storeCustomer($event->data);
    }
}
