<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AuctionItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auction_items')->truncate();

        $faker = Faker::create();
        for($i=0; $i<10; $i++){
            DB::table('auction_items')->insert([
                'event_id' => 1,
                'starts_at' => '2019-11-29 16:00:00',
                'ends_at' => '2019-11-29 20:00:00',
                'minimum_price' => $faker->randomDigit * 10

            ]);
        }
    }
}
