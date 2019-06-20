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
    	$path = storage_path('app/public/images');

        $user = User::first();
        for($n=0; $n<5; $n++)
        {
            $album = new Album;
            $album->owner = $user->id;
            $album->title = $faker->sentence(3);
            $album->description = $faker->sentence(10);
            $album->save();

            for($i=0; $i<10; $i++)
            {
                $image_path = $faker->image($path,
                    $faker->numberBetween(960, 1920),
                    $faker->numberBetween(540, 1028)
                );

                $image = Image::upload($image_path, $user->id);
                $image->owner = $user->id;
                $image->title = $faker->sentence(3);
                $image->description = $faker->sentence(10);
                $image->save();

                unlink($image_path);

                $album->images()->save($image);
                $user->my_images()->save($image);
            }

            $user->my_albums()->save($album);
        }

        return;

        User::all()->each(function($user) use ($path, $faker) {

            for($i=0; $i<3; $i++)
            {
                $album = new Album;
                $album->owner = $user->id;
                $album->title = $faker->sentence(3);
                $album->description = $faker->sentence(10);
                $album->save();

                for($i=0; $i<3; $i++)
                {
                    $image_path = $faker->image($path,
                        $faker->numberBetween(960, 1920),
                        $faker->numberBetween(540, 1028)
                    );

                    $image = Image::upload($image_path, $user->id);
                    $image->owner = $user->id;
                    $image->title = $faker->sentence(3);
                    $image->description = $faker->sentence(10);
                    $image->save();

                    unlink($image_path);

                    $album->images()->save($image);
                    $user->my_images()->save($image);
                }

                $user->my_albums()->save($album);
            }
        });
    }
}
