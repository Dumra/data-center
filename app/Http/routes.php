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
    return view('welcome');
});

$router->group(['domain' => 'api.data-center.dev', 'prefix' => 'v1'], function() use($router) {
    $router->get('/get/drone/{name?}', 'Drones\DroneController@getDrone');

    $router->post('/add/drone', 'Drones\DroneController@createDrone');

    $router->put('update/drone/{name}', 'Drones\DroneController@updateDrone');

    $router->delete('delete/drone/{name}', 'Drones\DroneController@deleteDrone');
});
