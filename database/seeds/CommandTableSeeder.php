<?php

use Illuminate\Database\Seeder;

class CommandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Data\Models\Command::class)->create([
            'latitude' => 25.52,
            'longitude' => 35.20,
            'height' => 4,
            'direction' => 'N',
            'added' => '2016-01-28 05:00:00',
            'drone_id' => 1
        ]);

        factory(App\Data\Models\Command::class)->create([
            'latitude' => 38.52,
            'longitude' => 42.20,
            'height' => 0,
            'direction' => 'S',
            'added' => '2016-01-12 07:00:00',
            'drone_id' => 2
        ]);

        factory(App\Data\Models\Command::class)->create([
            'latitude' => 85.11,
            'longitude' => 93.25,
            'height' => 8,
            'direction' => 'W',
            'added' => '2016-01-15 07:00:00',
            'drone_id' => 1
        ]);
    }
}
