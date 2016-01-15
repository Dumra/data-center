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

        $this->app->bind('App\\Data\\Repositories\\Commands\\CommandRepositoryInterface',
            'App\\Data\\Repositories\\Commands\\CommandRepository');

        $this->app->bind('App\\Data\\Repositories\\SensorValues\\SensorValueRepositoryInterface',
            'App\\Data\\Repositories\\SensorValues\\SensorValueRepository');
		
		 $this->app->bind('App\\Data\\Repositories\\Users\\UserRepositoryInterface',
            'App\\Data\\Repositories\\Users\\UserRepository');
		
		$this->app->bind('App\\Data\\Services\\MailService\\MailSenderInterface',
            'App\\Data\\Services\\MailService\\MailSender');
    }
}
