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


//Auth::routes();

/*Route::get('/welcome', function () {
    return view('welcome');
});*/

//Authentication
/*Route::get('/register', 'AuthController@register')->name('register');
Route::get('/login', 'AuthController@login')->name('login');
Route::get('/logout', 'AuthController@logout')->middleware('auth:web');*/

Route::get('/welcome', 'MembersController@welcome')->name('welcome');
Route::get('/index', "MembersController@index")->name('index')->middleware('IsAdmin');
Route::post('/store', "MembersController@store")->name('store');
Route::patch('/update/{id}', "MembersController@update")->name('update')->middleware('IsAdmin');
Route::delete('/delete/{id}', "MembersController@destroy")->name('destroy')->middleware('IsAdmin');
Route::get('/show/{id}', "MembersController@show")->name('show')->middleware('IsAdmin');

/*Route::get('/index', "MembersController@index")->name('index');
Route::post('/store', "MembersController@store")->name('store')->middleware("auth:web");
Route::patch('/update/{id}', "MembersController@update")->name('update')->middleware("auth:web");
Route::delete('/delete/{id}', "MembersController@destroy")->name('destroy')->middleware("auth:web");
Route::get('/show/{id}', "MembersController@show")->name('show')->middleware("auth:web");*/