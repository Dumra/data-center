<?php

use Illuminate\Database\Seeder;

class ValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Data\Models\SensorValue::class)->create([
            'value' => 25.52,
            'sensor_id' => 1
        ]);

        factory(App\Data\Models\SensorValue::class)->create([
            'value' => 35,
            'sensor_id' => 2
        ]);

        factory(App\Data\Models\SensorValue::class)->create([
            'value' => 45,
            'sensor_id' => 1
        ]);

        factory(App\Data\Models\SensorValue::class)->create([
            'value' => 66,
            'sensor_id' => 2
        ]);


    }
}
