<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Data\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(6)
    ];
});

$factory->define(App\Data\Models\Drone::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'type' => 'aircraft'
    ];
});

$factory->define(App\Data\Models\Sensor::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'drone_id' => '1'
    ];
});

$factory->define(App\Data\Models\Route::class, function (Faker\Generator $faker) {
    return [
        'latitude' => 25.52,
        'longitude' => 35.20,
        'height' => 4,
        'direction' => 'N',
        'battery' => 100,
        'added' => '1/12/2016 05:00:00',
        'drone_id' => 1
    ];
});

$factory->define(App\Data\Models\Command::class, function (Faker\Generator $faker) {
    return [
        // 'latitude' => 25.52,
        // 'longitude' => 35.20,
        'description' => 'Here will be some description',
        // 'height' => 4,
        // 'direction' => 'N',
        'added' => '1/12/2016 05:00:00',
        'drone_id' => 1
    ];
});

$factory->define(App\Data\Models\TaskValue::class, function (Faker\Generator $faker) {
    return [
        'latitude' => 25.52,
        'longitude' => 35.20,
        'height' => 4,
        'direction' => 'N',
        'task_id' => 1
    ];
});

$factory->define(App\Data\Models\SensorValue::class, function (Faker\Generator $faker) {
    return [
        'value' => 25.52,
        'latitude' => 28.52,
        'longitude' => 89.20,
        'added' => '1/12/2016 05:00:00',
        'sensor_id' => 1
    ];
});
