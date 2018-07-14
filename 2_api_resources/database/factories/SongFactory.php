<?php

use Faker\Generator as Faker;

$factory->define(App\Song::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'genre_id' => function () {
            return create(App\Genre::class)->id;
        },
        'artist_id' => function () {
            return create(App\Artist::class)->id;
        },
        'album_id'  => null,
    ];
});
