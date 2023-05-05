<?php

namespace Src\Customer\Domain\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;
use Src\Customer\Domain\Entities\CustomerEntity;

class CustomerUpdatedEvent extends ShouldBeStored
{
    public function __construct(
        public CustomerEntity $customerData,
        public string $uuid
    )
    {
    }
}
