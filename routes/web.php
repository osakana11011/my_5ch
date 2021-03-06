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

if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return redirect(route('threads'));
});

Auth::routes();

Route::get('/threads', 'ThreadController@index')->name('threads');
Route::get('/threads/search', 'ThreadController@crossingSearch')->name('threads.search');
Route::get('/threads/create', 'ThreadController@create')->name('threads.create');
Route::post('/threads', 'ThreadController@store')->name('threads.store');
Route::get('/threads/{id}', 'ThreadController@show')->name('threads.show');
Route::post('/threads/{id}/res', 'ResController@store')->name('threads.res.store');
