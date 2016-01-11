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

$router->group(['domain' => 'api.data-center.dev', 'prefix' => 'v1'], function() use($router) {	
	// Drones
    $router->get('/get/drone/{name?}', 'Drones\DroneController@getDrone');
	$router->get('/getType/drones/{type}', 'Drones\DroneController@getDroneByType');
	$router->get('/getSensors/drone/{name}', 'Drones\DroneController@getSensorsByDroneName');
	$router->get('/getRoutes/drone/{name}', 'Drones\DroneController@getRoutesByDroneName');
	$router->get('/getCommands/drone/{name}', 'Drones\DroneController@getCommandsByDroneName');
	$router->get('/getStatus/drones/{status}', 'Drones\DroneController@getDroneByStatus');
	$router->get('/getAvailable/drones/{available}', 'Drones\DroneController@getDroneByAvailable');
    $router->post('/add/drone', 'Drones\DroneController@createDrone');
    $router->put('/update/drone/{name}', 'Drones\DroneController@updateDrone');
    $router->delete('/delete/drone/{name}', 'Drones\DroneController@deleteDrone');
	// Sensors
	$router->get('/get/sensor/{name?}', 'Sensor\SensorController@getSensor');
	$router->get('/getDrone/sensor/{name}', 'Sensor\SensorController@getDroneBySensorName');
	$router->get('/getSensorValues/sensor/{name}', 'Sensor\SensorController@getSensorValuesBySensorName');
	$router->post('/add/sensor', 'Sensor\SensorController@createSensor');
	$router->put('/update/sensor/{name}', 'Sensor\SensorController@updateSensor');
	$router->delete('/delete/sensor/{name}', 'Sensor\SensorController@deleteSensor');
});
