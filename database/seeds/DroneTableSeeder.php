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
        DB::table('drones')->insert([
            [
                'name' => 'Fly1',
                'type' => 'aircraft'
            ],
            [
                'name' => 'Jeep1',
                'type' => 'machine'
            ]
        ]);
    }
}
