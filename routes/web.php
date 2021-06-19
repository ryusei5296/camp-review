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

Auth::routes();

Route::get('/','ReviewController@index')->name('index');

Route::get('/show/{id}', 'ReviewController@show')->name('show');

Route::get('/like/{id}', 'ReviewController@like')->name('review.like');
Route::get('/unlike/{id}', 'ReviewController@unlike')->name('review.unlike');

Route::group(['middleware' => 'auth'], function () {

Route::get('/review', 'ReviewController@create')->name('create');

Route::post('/review/store','ReviewController@store')->name('store');

Route::get('/res/{id}','ReviewController@res')->name('res');

Route::post('/res/{id}/store', 'ReviewController@res_store')->name('res-store');

Route::get('/delete/{id}', 'ReviewController@delete')->name('delete');

Route::get('/edit/{id}', 'ReviewController@edit')->name('edit');

Route::post('/edit/{id}', 'ReviewController@update')->name('update');

});

Route::get('/home', 'HomeController@index')->name('home');
