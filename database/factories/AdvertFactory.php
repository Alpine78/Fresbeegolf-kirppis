<?php

use Faker\Generator as Faker;

$factory->define(App\Advert::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->text(50),
        'content' => $faker->text(200),
        'brand' => $faker->text(20),
        'model' => $faker->text(40),
        'type' => $faker->numberBetween(0, 4),
        'condition' => $faker->numberBetween(1, 5),
        'price' => $faker->numberBetween(1, 50),
        'main_photo_id' => $faker->numberBetween(1, 4),
    ];
});
