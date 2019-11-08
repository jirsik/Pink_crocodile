<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Auction_item;
use App\Doner;
use App\Item;
use Faker\Generator as Faker;


$factory->define(Item::class, function (Faker $faker) {
    return [
        'title' => 'Item',
        'description' => $faker->sentence($nbWords = 7, $variableNbWords = true),
        'estimated_price' => $faker->randomNumber(2),
        'currency' => 'CZK',
        'doner_id' => $faker->randomNumber(1),
        'photo_path' => $faker->imageUrl($width = 640, $height = 480),
        'itemable_id' => $faker->randomNumber(2),
        'itemable_type' => 'AUC'
    ];
});

$factory->define(Donor::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'link' => $faker->url,
        'about' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'contact_name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'photo_path' => $faker->imageUrl($width = 640, $height = 480)
    ];
});

$factory->define(Auction_item::class, function (Faker $faker) {
    return [
        'event_id' => 1,
        'starts_at' => $faker->dateTime($max = 'now', $timezone = null),
        'ends_at' => $faker->dateTime($max = 'now', $timezone = null),
        'minimum_price' => $faker->randomNumber(2)
    ];
});
