<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$router->get('/', function () {
    return response('Here will be a web client!');
});

$router->group(['domain' => 'api.data-center.dev', 'prefix' => 'v1'], function () use ($router) {
    $router->group(['middleware' => 'throttle:5,1'], function () use ($router) {
        // Drones
        $router->get('/get/drone/{name?}', 'Drones\DroneController@getDrone');
        $router->get('/getType/drones/{type}', 'Drones\DroneController@getDroneByType');
        $router->get('/getSensors/drone/{name}', 'Drones\DroneController@getSensorsByDroneName');
        $router->get('/getRoutes/drone/{name}', 'Drones\DroneController@getRoutesByDroneName');
        $router->get('/getCommands/drone/{name}', 'Drones\DroneController@getCommandsByDroneName');
        $router->get('/getStatus/drones/{status}', 'Drones\DroneController@getDroneByStatus');
        $router->get('/getAvailable/drones/{available}', 'Drones\DroneController@getDroneByAvailable');
        // Sensors
        $router->get('/get/sensor/{name?}', 'Sensors\SensorController@getSensor');
        $router->get('/getDrone/sensor/{name}', 'Sensors\SensorController@getDroneBySensorName');
        $router->get('/getSensorValues/sensor/{name}', 'Sensors\SensorController@getSensorValuesBySensorName');
		// Routes
		$router->get('/get/route/{droneName?}', 'Routes\RouteController@getRouteByDroneName');
		$router->get('/get/route/{droneName}/{date}/{date_end?}', 'Routes\RouteController@getRouteByDate');
		// Commands
		$router->get('/get/command/{droneName?}', 'Commands\CommandController@getCommandByDroneName');
		$router->get('/get/command/{droneName}/{date}/{date_end?}', 'Commands\CommandController@getCommandByDate');
    });
    // Drones
    $router->post('/add/drone', 'Drones\DroneController@createDrone');
    $router->put('/update/drone/{name}', 'Drones\DroneController@updateDrone');
    $router->delete('/delete/drone/{name}', 'Drones\DroneController@deleteDrone');
    // Sensors
    $router->post('/add/sensor', 'Sensors\SensorController@createSensor');
    $router->put('/update/sensor/{name}', 'Sensors\SensorController@updateSensor');
    $router->delete('/delete/sensor/{name}', 'Sensors\SensorController@deleteSensor');
	// Routes
	$router->post('add/route', 'Routes\RouteController@addRoute');
	$router->put('/update/route/{id}', 'Routes\RouteController@updateRoute');
	$router->delete('delete/route/{id}', 'Routes\RouteController@deleteRoute');	
	// Commands
	$router->post('add/command', 'Commands\CommandController@addCommand');
	$router->put('/update/command/{id}', 'Commands\CommandController@updateCommand');
	$router->delete('delete/command/{id}', 'Commands\CommandController@deleteCommand');
});
