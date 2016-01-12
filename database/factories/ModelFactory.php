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
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
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
