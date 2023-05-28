<?php

namespace App\Listeners\Customer;

use App\Events\Customer\UpdateEvent;
use App\Repositories\Interfaces\CustomerRepositoryInterface;

class Update
{
    public function __construct(protected CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle(UpdateEvent $event)
    {
        return $this->customerRepository->updateCustomer($event->data, $event->id);
    }
}
