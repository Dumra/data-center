<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DroneServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\\Data\\Repositories\\Drones\\DroneRepositoryInterface',
            'App\\Data\\Repositories\\Drones\\DroneRepository');
    }
}
