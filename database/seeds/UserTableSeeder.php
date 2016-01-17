<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Data\Models\User::class)->create([
            'name' => 'barchinsky',
            'email' => 'barchinsky@gmail.com',			
        ]);

        factory(App\Data\Models\User::class)->create([
            'name' => 'udovechenkod',
            'email' => 'udovechenkod@gmail.com',			
        ]);
		
		factory(App\Data\Models\User::class)->create([
            'name' => 'alexeyzherehi',
            'email' => 'alexeyzherehi@gmail.com',			
        ]);
		
		factory(App\Data\Models\User::class)->create([
            'name' => 'dymedyuk',
            'email' => 'dymedyuk@gmail.com',			
        ]);
		
		factory(App\Data\Models\User::class)->create([
            'name' => 'kliw4utsky',
            'email' => 'kliw4utsky@gmail.com',			
        ]);
		
		factory(App\Data\Models\User::class)->create([
            'name' => 'roma.oncha',
            'email' => 'roma.oncha@gmail.com',			
        ]);
		
		factory(App\Data\Models\User::class)->create([
            'name' => 'd.shuliakov',
            'email' => 'd.shuliakov@gmail.com',
            'password' => '123456'
        ]);

    }
}
