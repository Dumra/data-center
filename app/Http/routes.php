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

$router->group(['domain' => env('API_DOMAIN'), 'prefix' => 'v1'], function () use ($router) {
	$router->group(['middleware' => 'jwt'], function () use ($router) {
		$router->group(['middleware' => 'throttle:100,1'], function () use ($router) {
			// Drones
			$router->get('/get/drone/{id?}', 'Api\Drones\DroneController@get');
			$router->get('/getType/drones/{type}', 'Api\Drones\DroneController@getByType');
			$router->get('/getSensors/drone/{id}', 'Api\Drones\DroneController@getSensors');
			$router->get('/getRoutes/drone/{id}', 'Api\Drones\DroneController@getRoutes');
			$router->get('/getCommands/drone/{id}', 'Api\Drones\DroneController@getCommands');
			$router->get('/getStatus/drones/{status}', 'Api\Drones\DroneController@getByStatus');
			$router->get('/getAvailable/drones/{available}', 'Api\Drones\DroneController@getByAvailable');
			// Sensors
			$router->get('/get/sensor/{id?}', 'Api\Sensors\SensorController@get');
			$router->get('/getDrone/sensor/{id}', 'Api\Sensors\SensorController@getDroneBySensorName');
			$router->get('/getSensorValues/sensor/{id}', 'Api\Sensors\SensorController@getSensorValuesBySensorName');
			// Routes
			$router->get('/get/route/{droneId?}', 'Api\Routes\RouteController@get');
			$router->get('/get/route/{droneId}/{date}/{date_end?}', 'Api\Routes\RouteController@getRouteByDate');
			// Commands
			$router->get('/get/command/{droneId?}', 'Api\Commands\CommandController@get');
			$router->get('/get/command/{droneId}/{date}/{date_end?}', 'Api\Commands\CommandController@getCommandByDate');
			// Values
			$router->get('/get/values/{sensorId?}', 'Api\SensorValues\SensorValuesController@get');
			$router->get('/get/values/{sensorId}/{date}/{date_end?}', 'Api\SensorValues\SensorValuesController@getValueByDate');
		});
		// Drones
		$router->post('/add/drone', 'Api\Drones\DroneController@createDrone');
		$router->put('/update/drone/{id}', 'Api\Drones\DroneController@updateDrone');
		$router->delete('/delete/drone/{id}', 'Api\Drones\DroneController@delete');
		// Sensors
		$router->post('/add/sensor', 'Api\Sensors\SensorController@createSensor');
		$router->put('/update/sensor/{id}', 'Api\Sensors\SensorController@updateSensor');
		$router->delete('/delete/sensor/{id}', 'Api\Sensors\SensorController@delete');
		// Routes
		$router->post('add/route', 'Api\Routes\RouteController@addRoute');
		$router->put('/update/route/{id}', 'Api\Routes\RouteController@updateRoute');
		$router->delete('delete/route/{id}', 'Api\Routes\RouteController@delete');
		// Commands
		$router->post('add/command', 'Api\Commands\CommandController@addCommand');
		$router->put('/update/command/{id}', 'Api\Commands\CommandController@updateCommand');
		$router->delete('delete/command/{id}', 'Api\Commands\CommandController@delete');
		// Values
		$router->post('add/value', 'Api\SensorValues\SensorValuesController@createValue');
		$router->put('/update/value/{id}', 'Api\SensorValues\SensorValuesController@updateValue');
		$router->delete('delete/value/{id}', 'Api\SensorValues\SensorValuesController@delete');
	});
	$router->post('get/token', 'Api\Auth\AuthController@authenticate');
});
