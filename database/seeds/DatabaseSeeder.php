<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(DroneTableSeeder::class);
        $this->call(SensorTableSeeder::class);
        $this->call(RouteTableSeeder::class);
        $this->call(CommandTableSeeder::class);
        $this->call(ValuesTableSeeder::class);

        Model::reguard();
    }
}
