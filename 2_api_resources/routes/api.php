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
Route::delete('/artists/{artist}', 'ArtistController@destroy');

Route::get('/artists/{artist}/albums', 'ArtistAlbumController@index');
Route::get('/artists/{artist}/songs', 'ArtistSongController@index');

Route::get('/songs', 'SongController@index');
Route::post('/songs', 'SongController@store');
Route::get('/songs/{song}', 'SongController@show');
Route::patch('/songs/{song}', 'SongController@update');
Route::delete('/songs/{song}', 'SongController@destroy');

Route::get('/albums', 'AlbumController@index');
Route::post('/albums', 'AlbumController@store');
Route::get('/albums/{album}', 'AlbumController@show');
Route::patch('/albums/{album}', 'AlbumController@update');
Route::delete('/albums/{album}', 'AlbumController@destroy');

Route::get('/albums/{album}/songs', 'AlbumSongController@index');
Route::patch('/albums/{album}/add-song/{song}', 'AlbumSongController@update');
Route::delete('/albums/{album}/remove-song/{song}', 'AlbumSongController@destroy');

Route::get('/playlists', 'PlaylistController@index');
Route::post('/playlists', 'PlaylistController@store');
Route::get('/playlists/{playlist}', 'PlaylistController@show');

Route::post('/playlists/{playlist}/add-song/{song}', 'PlaylistSongController@store');

Route::post('/users/{user}/upgrade', 'UpgradeUserController@index');
Route::get('/users/{user}/playlists', 'UserPlaylistController@index');
