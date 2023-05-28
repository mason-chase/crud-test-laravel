<?php

namespace App\Listeners\Customer;

use App\Events\Customer\DeleteEvent;
use App\Repositories\Interfaces\CustomerRepositoryInterface;

class Destroy
{
    public function __construct(protected CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle(DeleteEvent $event): void
    {
        $this->customerRepository->destroyCustomer($event->id);
    }
}
