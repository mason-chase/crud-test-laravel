<?php

namespace Domains\Customer\Listeners;

use Domains\Customer\Events\ShowEvent;
use Domains\Customer\Repositories\Interfaces\CustomerRepositoryInterface;

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
