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
});




// Route::get('XXX', 'AAAController@bbb');



Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('program/create', 'Admin\ProgramController@add');
     Route::post('program/create', 'Admin\ProgramController@create');
     Route::get('program', 'Admin\ProgramController@index');
     Route::get('program/edit', 'Admin\ProgramController@edit');
     Route::post('program/edit', 'Admin\ProgramController@update');
     Route::get('program/delete', 'Admin\ProgramController@delete');
     
     Route::get('profile/create', 'Admin\ProfileController@add');
     Route::post('profile/create', 'Admin\ProfileController@create'); 
     Route::get('profile', 'Admin\ProfileController@index');
     Route::get('profile/edit', 'Admin\ProfileController@edit');
     Route::post('profile/edit', 'Admin\ProfileController@update'); 
     Route::get('profile/delete', 'Admin\ProfileController@delete');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'ProgramController@index');
Route::get('/profile', 'ProfileController@index');