<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	App\User::create([
    		'name' => 'Bob',
	        'email' => 'bob@bob.bob',
	        'email_verified_at' => now(),
	        'password' => Hash::make('password'),
	        'remember_token' => Str::random(10),
    	]);

        factory(App\User::class, 9)->create();
    }
}
