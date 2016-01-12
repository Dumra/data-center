<?php

use Illuminate\Database\Seeder;

class DroneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Data\Models\Drone::class)->create([
            'name' => 'Fly1',
            'type' => 'aircraft'
        ]);

        factory(App\Data\Models\Drone::class)->create([
            'name' => 'Jeep1',
            'type' => 'machine'
        ]);
    }
}
