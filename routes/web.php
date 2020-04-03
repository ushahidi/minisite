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

Route::get('/site/{minisite}', 'SiteController@public')->name('minisitePublic');
Route::post('/site/{minisite}/{block}/email', 'SiteController@email')->name('sendSiteEmail');
Route::post('/search', 'NeighborhoodController@search')->name('search');
Route::get('/searching', 'HomeController@searching');
Route::get('/community', 'HomeController@community');
Route::get('/all-mahallas', 'HomeController@allMahallas');
Route::get('/add-blocks', 'HomeController@addBlocks');
Route::get('/add-block', 'HomeController@addBlock');
Route::get('/edit-block', 'HomeController@editBlock');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/neighborhood/create', 'NeighborhoodController@create')->name('neighborhoodCreate');
    Route::post('/neighborhood/{neighborhoodId}/invite', 'InviteController@generate')->name('inviteMember');
    Route::post('/neighborhood', 'NeighborhoodController@store')->name('neighborhoodStore');
    Route::get('/neighborhood', 'NeighborhoodController@show')->name('neighborhoodShow');    
    Route::get('/neighborhood/{id}', 'NeighborhoodController@show')->name('neighborhoodShow');    

    // minisites
    Route::get('/minisite/{minisite}/edit', 'MinisiteController@edit')->name('minisiteEdit');
    Route::put('/minisite/{minisite}', 'MinisiteController@update')->name('minisiteUpdate');

    // blocks
    Route::get('/minisite/{minisite}/block/create', 'BlockController@create')->name('blockCreate');
    Route::post('/minisite/{minisite}/block', 'BlockController@store')->name('blockStore');
    Route::get('/minisite/{minisite}/block/{block}/edit', 'BlockController@edit')->name('blockEdit');
    Route::put('/minisite/{minisite}/block/{blockId}', 'BlockController@update')->name('blockUpdate');
    Route::get('/minisite/{minisite}/block/{block}/destroy', 'BlockController@destroy')->name('blockDestroy');

});


Auth::routes();
