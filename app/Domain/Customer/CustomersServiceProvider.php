<?php

namespace App\Domain\Customer;

use App\Domain\Customer\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

class CustomersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
