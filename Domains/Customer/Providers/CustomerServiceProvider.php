<?php

namespace Domains\Customer\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'customer');
        $this->mergeConfigFrom(__DIR__."/../Config/customer.php", 'customer');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        
        Factory::guessFactoryNamesUsing(function ($modelName) {
            if($modelName == 'App\Models\User'){
                return 'Database\Factories\UserFactory';
            }
            return 'Domains\Customer\Database\Factories\CustomerFactory';
        });
    }
    
    public function boot(): void
    {
        //
    }
}
