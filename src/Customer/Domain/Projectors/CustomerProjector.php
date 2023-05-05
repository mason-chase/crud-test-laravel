<?php

namespace Src\Customer\Domain\Projectors;

use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use Src\Customer\Domain\Entities\CustomerModel;
use Src\Customer\Domain\Events\CustomerCreatedEvent;

class CustomerProjector extends Projector
{
    protected array $handleEvents = [
        CustomerCreatedEvent::class => 'onCustomerCreated'
    ];

    public function onCustomerCreated(CustomerCreatedEvent $event)
    {
        // TODO: put this to related repository
        CustomerModel::create((array)$event->customer);
    }
}
