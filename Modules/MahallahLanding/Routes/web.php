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
Route::get('/', 'MahallahLandingController@index');
Route::get('/search', 'MahallahLandingController@searchPage')->name('searchPage');
Route::post('/search', 'MahallahLandingController@search')->name('search');
