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
Route::get('/search', 'NeighborhoodManagerController@searchPage')->name('searchPage');
Route::post('/search', 'NeighborhoodManagerController@search')->name('search');
Route::prefix('neighborhoodmanager')->group(function() {
    
    Route::get('/user/invited/{token}', 'NeighborhoodManagerController@joinFromInvite')->name('joinFromInvite');

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
