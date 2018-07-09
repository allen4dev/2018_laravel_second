<?php

Route::get('/artists', function () {
    $artists = App\Artist::all()->toArray();

    return [
        'data' => $artists
    ];
});
