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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/user', 'HomeController@userDetails')->name('user.details');
Route::get('/user/{id}/edit', 'HomeController@editUser')->name('user.edit');
Route::post('/user/update/{id}', 'HomeController@updateUser')->name('user.update');
Route::get('/user/changeStatus/{id}', 'HomeController@changeUserStatus')->name('user.status');
