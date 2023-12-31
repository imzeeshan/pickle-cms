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

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'permission']], function ($route) {
    Route::get('/user/download', 'UserController@download')->name('user.download');
    Route::get('/user/import', 'UserController@import')->name('user.import');
    Route::post('/user/logout', 'UserController@logout')->name('user.logout');
    Route::resource('user', 'UserController');
    Route::get('/user/delete/{id}', 'UserController@destroy')->name('user.delete');
});
