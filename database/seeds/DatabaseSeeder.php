<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AuctionItemsTableSeeder::class);
        // $this->call(DonorsTableSeeder::class);
        // $this->call(EventsTableSeeder::class);
        // $this->call(ItemsTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
