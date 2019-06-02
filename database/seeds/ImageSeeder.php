<?php

use Illuminate\Database\Seeder;
use App\Image;
use App\User;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();
    	$path = storage_path('app\\public\\images');

    	for($i=0; $i<30; $i++)
    	{
    		$image = $faker->image($path, 1920, 1080);

		    $user = User::all()->random()->id;
			Image::upload($image, $user)->save();

			unlink($image);
    	}
    }
}
