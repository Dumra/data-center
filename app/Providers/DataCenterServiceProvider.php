<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DataCenterServiceProvider extends ServiceProvider
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
		
		$this->app->bind('App\\Data\\Repositories\\Sensors\\SensorRepositoryInterface',
            'App\\Data\\Repositories\\Sensors\\SensorRepository');
		
		$this->app->bind('App\\Data\\Repositories\\Routes\\RouteRepositoryInterface',
            'App\\Data\\Repositories\\Routes\\RouteRepository');
    }
}
