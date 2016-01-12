<?php

use Illuminate\Database\Seeder;

class SensorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Data\Models\Sensor::class)->create([
            'name' => 'Gaz1',
            'drone_id' => 1
        ]);

        factory(App\Data\Models\Sensor::class)->create([
            'name' => 'Temperature',
            'drone_id' => 2
        ]);
    }
}
