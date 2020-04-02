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

Route::prefix('neighborhoodmanager')->group(function() {
    Route::post('/search', 'NeighborhoodController@search')->name('search');
});
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('neighborhood')->group(function () {
        Route::get('/create', 'NeighborhoodManagerController@create')->name('neighborhoodCreate');
        Route::post('/{neighborhoodId}/invite', 'InviteController@generate')->name('inviteMember');
        Route::post('/', 'NeighborhoodManagerController@store')->name('neighborhoodStore');
        Route::get('/', 'NeighborhoodManagerController@show')->name('neighborhoodShow');    
        Route::get('/{id}', 'NeighborhoodManagerController@show')->name('neighborhoodShow');    
    });
});
