<?php

namespace Domains\Customer\Listeners;

use Domains\Customer\Events\StoreEvent;
use Domains\Customer\Repositories\Interfaces\CustomerRepositoryInterface;

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
