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
            'added' => '2016-01-01  05:00:00',
            'sensor_id' => 1
        ]);

        factory(App\Data\Models\SensorValue::class)->create([
            'value' => 35,
            'added' => '2016-01-02 05:00:00',
            'sensor_id' => 2
        ]);

        factory(App\Data\Models\SensorValue::class)->create([
            'value' => 45,
            'added' => '2016-01-03  05:00:00',
            'sensor_id' => 1
        ]);

        factory(App\Data\Models\SensorValue::class)->create([
            'value' => 66,
            'added' => '2016-01-04  05:00:00',
            'sensor_id' => 2
        ]);


    }
}
