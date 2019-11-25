<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DonorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doners')->truncate();

        $faker = Faker::create();
        for($i=0; $i<10; $i++){
            DB::table('doners')->insert([
                'name' => $faker->name,
                'link' => $faker->url,
                'about' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'contact_name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
                'doner_photo_path' => $faker->imageUrl($width = 640, $height = 480, 'people')
            ]);
        }
        
    }
}
