<?php

use Faker\Generator as Faker;

$factory->define(App\Artist::class, function (Faker $faker) {
    return [
        'fullname' => $faker->name,
        'nickname' => $faker->lastName,
        'age' => $faker->numberBetween(15, 50),
        'description' => $faker->sentence,
        'photo_url' => 'http://example.test/user/avatar',
    ];
});
