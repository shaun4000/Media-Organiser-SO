<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// COPY THESE ROUTES INTO YOUR OWN PROJECT
// Home page to view the main table
Route::get('/', 'App\Http\Controllers\AlbumController@index')->name('home');

// All routes to handle the Artist
Route::get('add-artist', 'App\Http\Controllers\ArtistController@create')->name('add-artist');
Route::post('add-artist', 'App\Http\Controllers\ArtistController@store')->name('add-artist');
Route::get('show-artist', 'App\Http\Controllers\ArtistController@show')->name('show-artist');
Route::get('edit-artist/{id?}', 'App\Http\Controllers\ArtistController@edit')->name('edit-artist');
Route::post('edit-artist-post', 'App\Http\Controllers\ArtistController@update')->name('edit-artist-post');
Route::post('delete-artist', 'App\Http\Controllers\ArtistController@destroy')->name('delete-artist');

// All routes to handle the Album
Route::get('add-album', 'App\Http\Controllers\AlbumController@create')->name('add-album');
Route::post('add-album', 'App\Http\Controllers\AlbumController@store')->name('add-album');
Route::get('show-album', 'App\Http\Controllers\AlbumController@show')->name('show-album');
Route::get('edit-album/{id}', 'App\Http\Controllers\AlbumController@edit')->name('edit-album');
Route::post('edit-album-post', 'App\Http\Controllers\AlbumController@update')->name('edit-album-post');
Route::post('delete-album', 'App\Http\Controllers\AlbumController@destroy')->name('delete-album');

// All routes to handle the song
Route::get('show-song', 'App\Http\Controllers\AlbumController@show_song')->name('show-song');
Route::post('edit-comment/{id?}', 'App\Http\Controllers\AlbumController@edit_comment')->name('edit-comment');

// All routes to handle the playlist
Route::get('playlists', 'App\Http\Controllers\PlaylistController@index')->name('playlists');
Route::get('add-playlist', 'App\Http\Controllers\PlaylistController@create')->name('add-playlist');
Route::post('add-playlist', 'App\Http\Controllers\PlaylistController@store')->name('add-playlist');
Route::get('show-playlist', 'App\Http\Controllers\PlaylistController@show')->name('show-playlist');
Route::get('edit-playlist/{id?}', 'App\Http\Controllers\PlaylistController@edit')->name('edit-playlist');
Route::post('edit-playlist-post', 'App\Http\Controllers\PlaylistController@update')->name('edit-playlist-post');
Route::post('delete-playlist', 'App\Http\Controllers\PlaylistController@destroy')->name('delete-playlist');

// All routes to handle the Categories
Route::get('categories', 'App\Http\Controllers\CategoryController@index')->name('categories');
Route::post('add-category', 'App\Http\Controllers\CategoryController@store')->name('add-category');
Route::post('edit-category/{id?}', 'App\Http\Controllers\CategoryController@update')->name('edit-category');
Route::post('delete-category/{id?}', 'App\Http\Controllers\CategoryController@destroy')->name('delete-category');

// All routes to handle the Backups
Route::get('db-backup', 'App\Http\Controllers\BackupController@backupDB')->name('db-backup');
Route::get('db-upload', 'App\Http\Controllers\BackupController@uploadDB')->name('db-upload');
Route::get('db-clean', 'App\Http\Controllers\BackupController@cleanDB')->name('db-clean');

// Download the User Guide
Route::get('uder-guide', 'App\Http\Controllers\BackupController@userGuide')->name('user-guide');
