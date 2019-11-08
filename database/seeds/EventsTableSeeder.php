<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->truncate();
        
        DB::table('events')->insert([
            'name' => 'Demo Day Auction',
            'location' => 'Data4You Coding Bootcamp Praha, 31 Táborska, 140 00 Praha 4',
            'starts_at' => '2019-11-29 16:00:00',
            'ends_at' => '2019-11-29 20:00:00',
            'coordinator' => 'Honza',
            'code' => 'DMO'
        ]);
    }
}
