<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->middleware(['api'])->group(function () {
    Route::prefix('auth')->middleware([])->namespace('CrCms\User\Http\Controllers\Api\Auth')->group(function () {
        Route::post('register', 'RegisterController@register');
        Route::post('login', 'LoginController@login');
        Route::post('forget-password', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('reset-password-url', 'ForgotPasswordController@postResetPasswordUrl')->name('user.auth.forget_password.reset_password_url');
        Route::post('reset-password', 'ResetPasswordController@reset')->name('user.auth.reset_password.reset');
        Route::post('verification', 'UserVerifyController@postVerify')->name('auth_verification.post');
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

