<?php

namespace Src\Customer\Application\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Src\Customer\Application\Common\Interfaces\CustomerRepositoryInterface;
use Src\Customer\Application\Common\Interfaces\CustomerServiceInterface;
use Src\Customer\Application\Common\Services\CustomerService;
use Src\Customer\Infrastructure\Persistence\CustomerRepository;

class CustomerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        App::bind(CustomerServiceInterface::class, CustomerService::class);

        App::bind(CustomerRepositoryInterface::class, CustomerRepository::class);
    }
}
