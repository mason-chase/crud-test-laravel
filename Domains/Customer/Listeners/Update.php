<?php

namespace Domains\Customer\Listeners;

use Domains\Customer\Events\UpdateEvent;
use Domains\Customer\Repositories\Interfaces\CustomerRepositoryInterface;

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
