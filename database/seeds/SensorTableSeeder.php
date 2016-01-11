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
        DB::table('sensors')->insert([
            [
                'name' => 'Sensor1_1',
                'drone_id' => '1'
            ],
            [
                'name' => 'Sensor2_1',
                'drone_id' => '1'
            ],
            [
                'name' => 'Sensor1_2',
                'drone_id' => '2'
            ]
        ]);
    }
}
