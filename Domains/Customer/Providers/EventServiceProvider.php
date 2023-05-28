<?php

namespace Domains\Customer\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        'Domains\Customer\Events\IndexEvent' => [
            'Domains\Customer\Listeners\Index',
        ],
        'Domains\Customer\Events\ShowEvent' => [
            'Domains\Customer\Listeners\Show',
        ],
        'Domains\Customer\Events\StoreEvent' => [
            'Domains\Customer\Listeners\Store',
        ],
        'Domains\Customer\Events\UpdateEvent' => [
            'Domains\Customer\Listeners\Update',
        ],
        'Domains\Customer\Events\DeleteEvent' => [
            'Domains\Customer\Listeners\Destroy',
        ],
    ];
}
