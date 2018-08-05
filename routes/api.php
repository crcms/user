<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api'])->group(function () {
    Route::domain('api.user.crcms.local')->namespace('CrCms\User\Http\Controllers\Api')
        ->middleware('auth:api')
        ->group(function(){
        Route::get('/','UserController@getShow')->name('test.index');
    });

    Route::prefix('manage')->namespace('CrCms\User\Http\Controllers\Api\Manage')->group(function () {
        Route::apiResource('users', 'UserController')->names([
            'index' => 'user.users.index',
            'store' => 'user.users.store',
            'update' => 'user.users.update',
            'destroy' => 'user.users.destroy',
        ])->except(['show']);
    });
});

