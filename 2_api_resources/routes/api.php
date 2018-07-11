<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/artists', 'ArtistController@index');
Route::get('/artists/{artist}', 'ArtistController@show');
Route::patch('/artists/{artist}', 'ArtistController@update');

Route::get('/songs', 'SongController@index');
Route::get('/songs/{song}', 'SongController@show');

Route::post('/users/{user}/upgrade', 'UpgradeUserController@index');
