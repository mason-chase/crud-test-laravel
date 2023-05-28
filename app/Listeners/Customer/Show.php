<?php

namespace App\Listeners\Customer;

use App\Events\Customer\ShowEvent;
use App\Repositories\Interfaces\CustomerRepositoryInterface;

class Show
{
    public function __construct(protected CustomerRepositoryInterface $customerRepository)
    {
    }

    public function handle(ShowEvent $event)
    {
        return $this->customerRepository->findCustomer($event->id);
    }
}
