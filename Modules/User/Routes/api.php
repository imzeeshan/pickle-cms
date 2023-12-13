<?php

use Illuminate\Http\Request;
use Modules\User\Http\Controllers\UserController;

Route::get('/user/create_token', 'UserController@create_token')->name('create.token');

Route::get('/user/revoke_token', 'UserController@revoke_token')->name('revoke.token');

Route::group(['prefix' => '/', 'middleware' => ['auth:sanctum', 'throttle:10']], function ($route) {
    Route::apiResource('user', 'UserController');
});
