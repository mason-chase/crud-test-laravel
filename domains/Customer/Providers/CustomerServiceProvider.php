<?php

namespace Domains\Customer\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->mergeConfigFrom(__DIR__ . "/../Config/config.php", 'customer');
        $this->loadTranslationsFrom(__DIR__ . "/../Lang", 'customer');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources', 'customer');

        Factory::guessFactoryNamesUsing(function ($modelName) {
            if ($modelName == 'App\Models\User') {
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