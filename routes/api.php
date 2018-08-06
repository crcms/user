<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->middleware(['api'])->namespace('CrCms\User\Http\Controllers\Api')->group(function () {

    Route::post('passport','CrCms\User\Http\Controllers\Api\PassportController@postPassport')->name('user.passport.post');

    Route::middleware('auth:api')->group(function(){
        Route::get('/','UserController@getShow')->name('test.index');
    });

});

// manage
Route::prefix('api/v1/manage')->middleware(['api'])->namespace('CrCms\User\Http\Controllers\Api\Manage')->group(function () {

    Route::apiResource('users', 'UserController')->names([
        'index' => 'user.manage.users.index',
        'store' => 'user.manage.users.store',
        'update' => 'user.manage.users.update',
        'destroy' => 'user.manage.users.destroy',
    ])->except(['show']);

});
