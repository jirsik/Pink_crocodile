<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        $faker = Faker::create();
        for($i=0; $i<10; $i++){
            DB::table('users')->insert([
                'first_name' => $faker->firstName($gender = null),
                'last_name' => $faker->lastName,
                'alias' => $faker->userName,
                'email' => $faker->email,
                'password' => '1234',
                'phone' => $faker->phoneNumber,
                'address_street_and_num' => $faker->streetAddress,
                'address_city' => $faker->city,
                'address_post_code' => $faker->postcode,
                'address_country' => $faker->country,
                'photo_path' => $faker->imageUrl($width=640, $height=480, 'people')

            ]);
        }
    }
}