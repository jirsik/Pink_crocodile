<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->truncate();

        $faker = Faker::create();
        for($i=0; $i<10; $i++){
            DB::table('items')->insert([
                'title' => $faker->word,
                'description' => $faker->sentence($nbWords = 7, $variableNbWords = true),
                'estimated_price' => $faker->randomNumber(2),
                'currency' => 'CZK',
                'doner' => $faker->name,
                'photo_path' => $faker->imageUrl($width = 640, $height = 480),
            ]);
        }
    }
}
