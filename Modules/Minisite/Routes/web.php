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

Route::prefix('minisite')->group(function() {
    Route::get('/', 'MinisiteController@index');
});

Route::prefix('minisite')->group(function() {
    Route::get('/{minisite}', 'MinisiteController@public')->name('minisitePublic');
    Route::post('/{minisite}/{block}/email', 'MinisiteController@email')->name('sendSiteEmail');
});