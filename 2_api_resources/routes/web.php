<?php

Route::get('/artists', 'ArtistController@index');
Route::get('/artists/{artist}', 'ArtistController@show');
