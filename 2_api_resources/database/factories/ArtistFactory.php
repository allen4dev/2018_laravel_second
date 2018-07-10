<?php

use Faker\Generator as Faker;

$factory->define(App\Artist::class, function (Faker $faker) {
    return [
        'user_id'     => function () {
            return create(App\User::class)->id;
        },
        'firstname'   => $faker->firstName,
        'lastname'    => $faker->lastName,
        'nickname'    => $faker->lastName,
        'age'         => $faker->numberBetween(15, 50),
        'description' => $faker->sentence,
        'photo_url'   => 'http://example.test/user/avatar',
    ];
});
