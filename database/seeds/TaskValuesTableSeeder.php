<?php

use Illuminate\Database\Seeder;

class TaskValuesTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Data\Models\TaskValue::class)->create([
            'latitude' => 25.52,
            'longitude' => 35.20,
            'height' => 4,
            'direction' => 'N',
            'task_id' => 1
        ]);

       factory(App\Data\Models\TaskValue::class)->create([
            'latitude' => 38.52,
            'longitude' => 42.20,
            'height' => 0,
            'direction' => 'S',
            'task_id' => 1
        ]);

        factory(App\Data\Models\TaskValue::class)->create([
            'latitude' => 85.11,
            'longitude' => 93.25,
            'height' => 8,
            'direction' => 'W',
            'task_id' => 2
        ]);

        factory(App\Data\Models\TaskValue::class)->create([
            'latitude' => 99.11,
            'longitude' => 34.25,
            'height' => 15,
            'direction' => 'N',
            'task_id' => 3
        ]);


    }
}