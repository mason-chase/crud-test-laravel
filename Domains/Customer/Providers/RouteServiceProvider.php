<?php

namespace Domains\Customer\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function register(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    }
}
