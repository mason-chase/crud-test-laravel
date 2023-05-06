<?php

namespace App\Domain\Customer\Projectors;

use App\Domain\Customer\Events\CustomerCreated;
use App\Domain\Customer\Events\CustomerDeleted;
use App\Domain\Customer\Events\CustomerUpdated;
use App\Domain\Customer\Models\Customer;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class CustomerProjector extends Projector
{
    public function onCustomerCreated(CustomerCreated $event)
    {
        $data = $event->data;
        $data['uuid'] = $event->uuid;

        Customer::query()->create($data);
    }

    public function onCustomerUpdated(CustomerUpdated $event)
    {
        Customer::query()
            ->where(Customer::COL_UUID, $event->uuid)
            ->update($event->data);
    }

    public function onCustomerDeleted(CustomerDeleted $event)
    {
        Customer::query()
            ->where(Customer::COL_UUID, $event->uuid)
            ->delete();
    }
}
