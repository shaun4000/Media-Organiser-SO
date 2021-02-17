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

Route::get('/', 'App\Http\Controllers\AlbumController@index')->name('home');

Route::get('add-artist', 'App\Http\Controllers\ArtistController@create')->name('add-artist');
Route::post('add-artist', 'App\Http\Controllers\ArtistController@store')->name('add-artist');
Route::get('show-artist', 'App\Http\Controllers\ArtistController@show')->name('show-artist');
Route::get('edit-artist/{id?}', 'App\Http\Controllers\ArtistController@edit')->name('edit-artist');
Route::post('edit-artist-post', 'App\Http\Controllers\ArtistController@update')->name('edit-artist-post');
Route::post('delete-artist', 'App\Http\Controllers\ArtistController@destroy')->name('delete-artist');

Route::get('add-album', 'App\Http\Controllers\AlbumController@create')->name('add-album');
Route::post('add-album', 'App\Http\Controllers\AlbumController@store')->name('add-album');
Route::get('show-album', 'App\Http\Controllers\AlbumController@show')->name('show-album');
Route::get('edit-album/{id?}', 'App\Http\Controllers\AlbumController@edit')->name('edit-album');
Route::post('edit-album-post', 'App\Http\Controllers\AlbumController@update')->name('edit-album-post');
Route::post('delete-album', 'App\Http\Controllers\AlbumController@destroy')->name('delete-album');

Route::get('show-song', 'App\Http\Controllers\AlbumController@show_song')->name('show-song');

