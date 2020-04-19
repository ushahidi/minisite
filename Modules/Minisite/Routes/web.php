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
Route::get('/site/{community}', 'BlockManagerController@index')->name('minisite.admin');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/{community}/reorder', 'BlockManagerController@reorder')->name('minisite.admin.reorder');
    Route::post('/{community}/reorder', 'BlockManagerController@saveOrder')->name('minisite.admin.reorder.submit');

    Route::get('/{community}/block/types', 'BlockController@getTypes')->name('blockTypes');

    Route::get('/{community}/block/create', 'BlockController@create')->name('createByType');

    Route::put('/{community}', 'BlockManagerController@update')->name('communityUpdate');

    // blocks
    // Route::get('/{community}/block/create', 'BlockController@create')->name('blockCreate');
    Route::post('/{community}/block', 'BlockController@store')->name('blockStore');
    Route::get('/{community}/block/{block}/edit', 'BlockController@edit')->name('blockEdit');
    Route::put('/{community}/block/{block}', 'BlockController@update')->name('blockUpdate');
    Route::get('/{community}/block/{block}/destroy', 'BlockController@destroy')->name('blockDestroy');
});

Route::prefix('communitymanager')->group(function() {
    
    Route::get('/user/invited/{token}', 'CommunityManagerController@joinFromInvite')->name('joinFromInvite');

});
Route::post('/{community}/{block}/email', 'CommunityManagerController@email')->name('sendSiteEmail');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'CommunityManagerController@all')->name('home');
    Route::prefix('community')->group(function () {
        Route::get('/create', 'CommunityManagerController@create')->name('communityCreate');
        Route::get('/{community}/edit', 'CommunityManagerController@edit')->name('communityEdit');
        
        Route::post('/{communityId}/invite', 'InviteController@generate')->name('inviteMember');
        Route::post('/', 'CommunityManagerController@store')->name('communityStore');
        Route::put('/{community}', 'CommunityManagerController@update')->name('communityUpdate');

        Route::get('/{community}/location', 'CommunityManagerController@getLocationOptions')->name('getLocationOptions');
        Route::post('/{community}/location', 'CommunityManagerController@storeLocation')->name('communitySetLocation');
        Route::get('/', 'CommunityManagerController@show')->name('communityShow');    
        Route::get('/{id}', 'CommunityManagerController@show')->name('communityShow');    
        Route::get('/{community}/members', 'CommunityManagerController@members')->name('community.members');
        Route::get('/{community}/members/invite', 'CommunityManagerController@inviteMembers')->name('community.members.invite');
        Route::post('/{community}/members/invite', 'CommunityManagerController@sendInvites')->name('community.members.invite.send');
        Route::get('/{community}/members/{user}', 'CommunityManagerController@member')->name('community.member');
        Route::put('/{community}/members/{user}', 'CommunityManagerController@updateMember')->name('community.member.update');

    });
});
