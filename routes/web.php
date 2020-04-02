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

Route::get('/', 'HomeController@welcome');
Route::get('/user/invited/{token}', 'NeighborhoodController@joinFromInvite')->name('joinFromInvite');

Route::post('/search', 'NeighborhoodController@search')->name('search');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/neighborhood/create', 'NeighborhoodController@create')->name('neighborhoodCreate');
    Route::post('/neighborhood/{neighborhoodId}/invite', 'InviteController@generate')->name('inviteMember');
    Route::post('/neighborhood', 'NeighborhoodController@store')->name('neighborhoodStore');
    Route::get('/neighborhood', 'NeighborhoodController@show')->name('neighborhoodShow');    
    Route::get('/neighborhood/{id}', 'NeighborhoodController@show')->name('neighborhoodShow');    


});


Auth::routes();
