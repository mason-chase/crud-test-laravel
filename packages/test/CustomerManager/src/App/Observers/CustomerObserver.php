<?php

namespace Test\CustomerManager\App\Observers;

use Test\CustomerManager\App\Events\CustomerCreatedEvent;
use Test\CustomerManager\App\Events\CustomerDeletedEvent;
use Test\CustomerManager\App\Events\CustomerUpdatedEvent;
use Test\CustomerManager\Models\Customer;

class CustomerObserver
{
    public function created(Customer $customer): void
    {
        event(new CustomerCreatedEvent($customer));
    }

    public function updated(Customer $customer): void
    {
        event(new CustomerUpdatedEvent($customer));
    }

    public function deleted(Customer $customer): void
    {
        event(new CustomerDeletedEvent($customer));
    }

    public function restored(Customer $customer): void
    {
        //
    }

    public function forceDeleted(Customer $customer): void
    {
        //
    }
}
