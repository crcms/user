<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api'])->group(function () {
    Route::prefix('api/v1')->namespace('CrCms\User\Http\Controllers\Api')
        ->middleware('auth:api')
        ->group(function(){
        Route::get('/','UserController@getShow')->name('test.index');

    });

    Route::any('passport','CrCms\User\Http\Controllers\Api\PassportController@check');

    Route::prefix('manage')->namespace('CrCms\User\Http\Controllers\Api\Manage')->group(function () {
        Route::apiResource('users', 'UserController')->names([
            'index' => 'user.users.index',
            'store' => 'user.users.store',
            'update' => 'user.users.update',
            'destroy' => 'user.users.destroy',
        ])->except(['show']);
    });
});

