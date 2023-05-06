<?php

namespace App\Domain\Customer;

use App\Domain\Customer\Events\CustomerCreated;
use App\Domain\Customer\Events\CustomerDeleted;
use App\Domain\Customer\Events\CustomerUpdated;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class CustomerAggregateRoot extends AggregateRoot
{
    public function createCustomer(array $data)
    {
        $this->recordThat(new CustomerCreated($this->uuid(),$data));

        return $this;
    }

    public function updateCustomer(string $uuid, array $data)
    {
        $this->recordThat(new CustomerUpdated($uuid, $data));

        return $this;
    }

    public function deleteCustomer(string $uuid)
    {
        $this->recordThat(new CustomerDeleted($uuid));

        return $this;
    }
}
