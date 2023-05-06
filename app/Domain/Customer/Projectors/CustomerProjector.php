<?php

namespace App\Domain\Customer\Projectors;

use App\Domain\Customer\Events\CustomerCreated;
use App\Domain\Customer\Events\CustomerDeleted;
use App\Domain\Customer\Events\CustomerUpdated;
use App\Domain\Customer\Models\Customer;
use App\Domain\Customer\Repositories\CustomerRepository;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class CustomerProjector extends Projector
{
    public function onCustomerCreated(CustomerCreated $event)
    {
        $data = $event->data;
        $data['uuid'] = $event->uuid;
        $repository = new CustomerRepository(app());
        $repository->create($data);
    }

    public function onCustomerUpdated(CustomerUpdated $event)
    {
        $this->repository()->update($event->data, $event->uuid);
    }

    public function onCustomerDeleted(CustomerDeleted $event)
    {
        $this->repository()->delete($event->uuid);
    }

    private function repository()
    {
        return new CustomerRepository(app());
    }
}
