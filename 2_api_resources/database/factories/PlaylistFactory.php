<?php

use Faker\Generator as Faker;

$factory->define(App\Playlist::class, function (Faker $faker) {
    return [
        'user_id'     => function () {
            return create(App\User::class)->id;
        },
        'title'       => $faker->sentence,
        'description' => $faker->text,
    ];
});
