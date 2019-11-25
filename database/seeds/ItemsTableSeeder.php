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
                'title' => 'Item'.($i+1),
                'description' => $faker->sentence($nbWords = 7, $variableNbWords = true),
                'estimated_price' => $faker->randomDigit * 100,
                'currency' => 'CZK',
                'doner_id' => ($i+1),
                'item_photo_path' => $faker->imageUrl($width = 640, $height = 480, 'technics'),
                'itemable_id' => ($i+1),
                'itemable_type' => 'App\AuctionItem'
            ]);
        }
    }
    // public function run()
    // {
    //     factory(App\Item::class, 10)->create();
    // }
}
