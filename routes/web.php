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

Route::get('/admin/users', 'AdminUsersController@index');

Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');

Route::put('/users/{id}/', 'UsersController@update')->name('users.update');


Route::resource('/admin/restaurants', 'RestaurantController');

Route::get('/search', 'SearchController@search')->name('search');

Route::get('/{search}/restaurants/{restaurant}', 'SearchController@show')->name('show');

Route::get('/{search}/restaurants/{restaurant}/comments/create', 'CommentController@create')->name('comments.create');

Route::post('restaurants/comments', 'CommentController@store')->name('comments.store');

Route::get('/{search}/restaurants/comments/{comment}/edit', 'CommentController@edit')->name('comments.edit');

Route::patch('/restaurants/comments/{comment}', 'CommentController@update')->name('comments.update');

Route::delete('/restaurants/comments/{comment}', 'CommentController@destroy')->name('comments.destroy');

