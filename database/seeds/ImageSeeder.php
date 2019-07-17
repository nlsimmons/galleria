<?php

use Illuminate\Database\Seeder;
use App\Image;
use App\Album;
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

        User::all()->each(function($user) use ($faker){
            for($n=0; $n<2; $n++)
            {
                $album = new Album;
                $album->owner_id = $user->id;
                $album->title = $faker->sentence(3);
                $album->description = $faker->sentence(10);
                $album->save();

                for($i=0; $i<8; $i++)
                {
                    $image_path = $faker->imageUrl(
                        $faker->numberBetween(1440, 1920),
                        $faker->numberBetween(784, 1028)
                    );

                    $image = Image::upload($image_path, $user->id);
                    $image->owner_id = $user->id;
                    $image->title = $faker->sentence(3);
                    $image->description = $faker->sentence(10);
                    $image->save();

                    $album->images()->save($image);
                    $user->images()->save($image);
                }

                $user->albums()->save($album);
            }
        });
    }
}
