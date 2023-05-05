<?php

namespace Src\Customer\Domain\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CustomerDeletedEvent extends ShouldBeStored
{
    public function __construct(public $customer)
    {
    }
}
