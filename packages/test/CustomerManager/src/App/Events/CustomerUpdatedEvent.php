<?php

namespace Test\CustomerManager\App\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;
use Test\CustomerManager\Models\Customer;

class CustomerUpdatedEvent extends ShouldBeStored
{
    public function __construct(public Customer $customer){}

}
