<?php

namespace Test\BaceManager\Providers;

use Illuminate\Support\ServiceProvider;

class BaseManagerServiceProvider extends ServiceProvider {

    public function boot()
    {   

        $this->mergeConfigFrom(__DIR__.'/../config/BaceManager.php', 'BaceManager');

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        $this->loadRoutesFrom(__DIR__.'/../App/Http/Routes/api.php');
        
        $this->publish();

    }

    public function register(){

    }

    public function publish()
    {
        $this->publishes([
            __DIR__.'/../config/BaceManager.php' => config_path('BaceManager.php'),
        ],'config');

    }
}