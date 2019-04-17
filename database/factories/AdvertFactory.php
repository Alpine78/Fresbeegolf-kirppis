<?php

use Faker\Generator as Faker;

$factory->define(App\Advert::class, function (Faker $faker) {
    $fakedate = $faker->date('Y-m-d', 'now');
    return [
        'user_id' => $faker->numberBetween(1, 5),
        'title' => $faker->text(50),
        'content' => $faker->text(300),
        'brand' => $faker->text(20),
        'model' => $faker->text(40),
        'type' => $faker->numberBetween(0, 4),
        'condition' => $faker->numberBetween(1, 5),
        'price' => $faker->numberBetween(1, 50),
        'main_photo_id' => 1,
        //'accepted_at' => $fakedate,
        'created_at' => $fakedate,
        'updated_at' => $fakedate,
        'photo' => 'images/1555435439.jpeg'
    ];
});
// dateTimeBetween($startDate = '-2 years', $endDate = 'now')
// date_time_between(start_date="-30y", end_date="now", tzinfo=None)
