<?php

namespace App\Domain\Customer\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CustomerUpdated extends ShouldBeStored
{
    public function __construct(
        public string $uuid,
        public array $data
    ) {
    }
}
