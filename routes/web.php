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

Route::get('/welcome', 'MembersController@welcome')->name('welcome');
Route::get('/index', "MembersController@index")->name('index')->middleware('IsAdmin');
Route::post('/store', "MembersController@store")->name('store');
Route::patch('/update/{id}', "MembersController@update")->name('update')->middleware('IsAdmin');
Route::delete('/delete/{id}', "MembersController@destroy")->name('destroy')->middleware('IsAdmin');
Route::get('/show/{id}', "MembersController@show")->name('show')->middleware('IsAdmin');

//Roles
Route::post('/dashboard/{member_id}', 'RolesController@dashboard')->name('dashboard')->middleware('IsAdmin');
Route::patch('/dashboard/update_member_role', 'RolesController@addRoleToMember')->name('addRoleToMember')->middleware('IsAdmin');