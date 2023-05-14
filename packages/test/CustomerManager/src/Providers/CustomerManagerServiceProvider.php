<?php

namespace Test\CustomerManager\Providers;

use Illuminate\Support\ServiceProvider;
use Test\CustomerManager\App\Observers\CustomerObserver;
use Test\CustomerManager\Models\Customer;

class CustomerManagerServiceProvider extends ServiceProvider {

    public function boot()
    {   
        $this->mergeConfigFrom(__DIR__.'/../config/CustomerManager.php', 'CustomerManager');

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'customers');

        $this->loadRoutesFrom(__DIR__.'/../App/Http/Routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/../App/Http/Routes/web.php');

        
        $this->publish();

        Customer::observe(CustomerObserver::class);

    }

    public function register(){

    }

    public function publish()
    {
        $this->publishes([
            __DIR__.'/../config/CustomerManager.php' => config_path('CustomerManager.php'),
        ],'config');

    }
}