<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\VehicleRepository::class, \App\Repositories\VehicleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RouteRepository::class, \App\Repositories\RouteRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SupplyRepository::class, \App\Repositories\SupplyRepositoryEloquent::class);
        //:end-bindings:
    }
}
