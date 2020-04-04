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
Route::prefix('communitymanager')->group(function() {
    
    Route::get('/user/invited/{token}', 'CommunityManagerController@joinFromInvite')->name('joinFromInvite');

});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'CommunityManagerController@all')->name('home');
    Route::prefix('community')->group(function () {
        Route::get('/create', 'CommunityManagerController@create')->name('communityCreate');
        Route::post('/{communityId}/invite', 'InviteController@generate')->name('inviteMember');
        Route::post('/', 'CommunityManagerController@store')->name('communityStore');
        Route::get('/', 'CommunityManagerController@show')->name('communityShow');    
        Route::get('/{id}', 'CommunityManagerController@show')->name('communityShow');    
    });
});
