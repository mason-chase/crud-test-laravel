<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
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
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        'App\Events\Customer\IndexEvent' => [
            'App\Listeners\Customer\Index',
        ],
        'App\Events\Customer\ShowEvent' => [
            'App\Listeners\Customer\Show',
        ],
        'App\Events\Customer\StoreEvent' => [
            'App\Listeners\Customer\Store',
        ],
        'App\Events\Customer\UpdateEvent' => [
            'App\Listeners\Customer\Update',
        ],
        'App\Events\Customer\DeleteEvent' => [
            'App\Listeners\Customer\Destroy',
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
