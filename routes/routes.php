<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'middleware' => ['passport:users', 'auth:api']], function () {
    Route::get('/profile', [OZiTAG\Tager\Backend\User\Controllers\ProfileController::class, 'index']);
    Route::put('/profile', [OZiTAG\Tager\Backend\User\Controllers\ProfileController::class, 'update']);
    Route::post('/profile/password', [OZiTAG\Tager\Backend\User\Controllers\ProfileController::class, 'changePassword']);
    Route::post('/profile/logout', [OZiTAG\Tager\Backend\User\Controllers\ProfileController::class, 'logout']);
});
