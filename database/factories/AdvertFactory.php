<?php

use Faker\Generator as Faker;

$factory->define(App\Advert::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->text(50),
        'content' => $faker->text(200),
        'brand' => $faker->text(25),
        'name' => $faker->text(40),
        'type' => $faker->numberBetween(0, 4),
        'price' => $faker->numberBetween(1, 50),
        'accepted_at' => $faker->dateTimeBetween('-1 months', 'now'),
        'refused_at' => $faker->dateTimeBetween('-1 months', 'now'),
        'marked_sold_at' => $faker->dateTimeBetween('-1 months', 'now'),
        'flagged_at' => $faker->dateTimeBetween('-1 months', 'now'),
        'reason_to_remove' => $faker->numberBetween(0, 4),
        'main_photo_id' => $faker->numberBetween(0, 4),
    ];
});
