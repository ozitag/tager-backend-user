<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'middleware' => ['passport:users', 'auth:api']], function () {
    Route::get('/profile', [OZiTAG\Tager\Backend\User\Controllers\ProfileController::class, 'index']);
    Route::put('/profile', [OZiTAG\Tager\Backend\User\Controllers\ProfileController::class, 'update']);
    Route::post('/profile/password', [OZiTAG\Tager\Backend\User\Controllers\ProfileController::class, 'changePassword']);
    Route::post('/profile/logout', [OZiTAG\Tager\Backend\User\Controllers\ProfileController::class, 'logout']);
});

Route::group(['prefix' => 'tager/restore', 'middleware' => ['passport:users']], function () {
    Route::post('/', [OZiTAG\Tager\Backend\User\Controllers\RestoreController::class, 'index']);
    Route::post('/check', [OZiTAG\Tager\Backend\User\Controllers\RestoreController::class, 'check']);
    Route::post('/complete', [OZiTAG\Tager\Backend\User\Controllers\RestoreController::class, 'complete']);
});
