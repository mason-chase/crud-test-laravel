<?php

namespace App\Domain\Customer\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CustomerDeleted extends ShouldBeStored
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
