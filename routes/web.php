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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/threads', 'ThreadController@index')->name('threads');
Route::get('/threads/create', 'ThreadController@create')->name('threads.create');
Route::post('threads', 'ThreadController@store')->name('threads.store');
