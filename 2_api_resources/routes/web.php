<?php

Route::get('/artists', 'ArtistController@index');
Route::get('/artists/{artist}', 'ArtistController@show');

Route::get('/songs', 'SongController@index');
