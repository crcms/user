<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->middleware(['api'])->group(function () {
    Route::prefix('auth')->middleware([])->namespace('CrCms\User\Http\Controllers\Api\Auth')->group(function(){
        Route::post('register','RegisterController@register');
        Route::post('login','LoginController@login');
    });

    Route::prefix('manage')->namespace('CrCms\User\Http\Controllers\Api\Manage')->group(function(){
        Route::resource('users','UserController');
    });
});

