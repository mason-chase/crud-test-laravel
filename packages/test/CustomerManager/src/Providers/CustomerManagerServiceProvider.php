<?php

namespace Test\CustomerManager\Providers;

use Illuminate\Support\ServiceProvider;

class CustomerManagerServiceProvider extends ServiceProvider {

    public function boot()
    {   

        $this->mergeConfigFrom(__DIR__.'/../config/CustomerManager.php', 'CustomerManager');

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        $this->loadRoutesFrom(__DIR__.'/../App/Http/Routes/api.php');
        
        $this->publish();

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