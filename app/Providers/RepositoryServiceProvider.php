<?php

namespace App\Providers;

use App\Domains\Customer\Domain\Repositories\CustomerRepositoryInterface;
use App\Domains\Customer\Infrastructure\Eloquent\EloquentCustomerRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $singletons = [
        CustomerRepositoryInterface::class => EloquentCustomerRepository::class
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
