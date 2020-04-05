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

Route::group(['middleware' => 'auth'], function () {

    Route::prefix('blockmanager')->group(function() {
        Route::get('/{community}/edit', 'BlockManagerController@edit')->name('communityBlocksEdit');
        
        Route::get('/{community}/block/types', 'BlockController@getTypes')->name('blockTypes');

        Route::get('/{community}/block/create', 'BlockController@getTypes')->name('createByType');

        Route::put('/{community}', 'BlockManagerController@update')->name('communityUpdate');

        // blocks
        // Route::get('/{community}/block/create', 'BlockController@create')->name('blockCreate');
        Route::post('/{community}/block', 'BlockController@store')->name('blockStore');
        Route::get('/{community}/block/{block}/edit', 'BlockController@edit')->name('blockEdit');
        Route::put('/{community}/block/{blockId}', 'BlockController@update')->name('blockUpdate');
        Route::get('/{community}/block/{block}/destroy', 'BlockController@destroy')->name('blockDestroy');
    });

});