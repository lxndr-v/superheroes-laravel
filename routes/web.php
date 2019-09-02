<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::delete('/{superhero}', 'PicturesController@destroy')->name('superhero');
// Route::delete('/pictures/{id}', 'PicturesController@deletePicture');
Route::resource('/pictures', 'PicturesController');
Route::resource('/superhero', 'SuperheroesController');

Route::get('/', 'SuperheroesController@index')->name('superhero');
// Route::post('/', 'SuperheroesController@store')->name('superhero');
// Route::get('/create', 'SuperheroesController@create')->name('superhero');
// Route::put('/{superhero}', 'SuperheroesController@update')->name('superhero');
// Route::get('/{superhero}', 'SuperheroesController@show')->name('superhero');
// Route::delete('/{superhero}', 'SuperheroesController@destroy')->name('superhero');
// Route::get('/{superhero}/edit', 'SuperheroesController@edit')->name('superhero');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
