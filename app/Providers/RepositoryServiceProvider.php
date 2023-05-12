<?php

namespace App\Providers;

use Ddd\Domain\Customer\CustomerRepositoryInterface;
use Ddd\Infrastructure\Persistence\Eloquent\EloquentCustomerRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind Interface and Repository class together
        $this->app->bind(CustomerRepositoryInterface::class, EloquentCustomerRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
