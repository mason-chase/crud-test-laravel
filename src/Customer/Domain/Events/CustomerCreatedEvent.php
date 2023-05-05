<?php

namespace Src\Customer\Domain\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CustomerCreatedEvent extends ShouldBeStored
{
    public function __construct(public object $customer)
    {
    }
}
