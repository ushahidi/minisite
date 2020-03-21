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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/user/invited/{token}', 'NeighborhoodController@joinFromInvite')->name('joinFromInvite');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/neighborhood/create', 'NeighborhoodController@create')->name('neighborhoodCreate');
    
    Route::post('/neighborhood/{neighborhoodId}/invite', 'InviteController@generate')->name('inviteMember');
    
    Route::post('/neighborhood', 'NeighborhoodController@store')->name('neighborhoodStore');
    Route::get('/neighborhood/{id}', 'NeighborhoodController@show')->name('neighborhoodShow');    
});

