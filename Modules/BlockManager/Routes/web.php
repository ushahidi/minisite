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

Route::prefix('blockmanager')->group(function() {
    Route::get('/{minisite}/edit', 'BlockManagerController@edit')->name('minisiteEdit');
    Route::put('/{minisite}', 'BlockManagerController@update')->name('minisiteUpdate');

    // blocks
    Route::get('/{minisite}/block/create', 'BlockController@create')->name('blockCreate');
    Route::post('/{minisite}/block', 'BlockController@store')->name('blockStore');
    Route::get('/{minisite}/block/{block}/edit', 'BlockController@edit')->name('blockEdit');
    Route::put('/{minisite}/block/{blockId}', 'BlockController@update')->name('blockUpdate');
    Route::get('/{minisite}/block/{block}/destroy', 'BlockController@destroy')->name('blockDestroy');
});
