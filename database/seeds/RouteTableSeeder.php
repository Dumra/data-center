<?php

use Illuminate\Database\Seeder;

class RouteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Data\Models\Route::class)->create([
            'latitude' => 25.52,
            'longitude' => 35.20,
            'height' => 4,
            'direction' => 'N',
            'battery' => 100,
            'added' => '2016-01-28 05:00:00',
            'drone_id' => 1
        ]);

        factory(App\Data\Models\Route::class)->create([
            'latitude' => 38.52,
            'longitude' => 42.20,
            'height' => 0,
            'direction' => 'S',
            'battery' => 50,
            'added' => '2016-01-12 07:00:00',
            'drone_id' => 2
        ]);
    }
}
