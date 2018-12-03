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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/admin/users', 'AdminUsersController@index');

Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{id}/', 'UsersController@update')->name('users.update');


Route::resource('admin/restaurants', 'RestaurantController');

Route::get('search', 'SearchController@search')->name('search');
Route::get('restaurants/{restaurant}', 'SearchController@show')->name('show');

