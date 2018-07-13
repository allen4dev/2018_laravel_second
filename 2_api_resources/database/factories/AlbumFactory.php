<?php

use Faker\Generator as Faker;

$factory->define(App\Album::class, function (Faker $faker) {
    return [
        'artist_id' => function () {
            return create(App\Artist::class)->id;
        },
        'title'  => $faker->sentence,
    ];
});
