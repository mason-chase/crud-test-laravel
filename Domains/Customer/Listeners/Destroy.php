<?php

namespace Domains\Customer\Listeners;

use Domains\Customer\Events\DeleteEvent;
use Domains\Customer\Repositories\Interfaces\CustomerRepositoryInterface;

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
