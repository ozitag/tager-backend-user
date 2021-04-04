<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'tager/restore', 'middleware' => ['passport:users']], function () {
    Route::post('/', [OZiTAG\Tager\Backend\User\Controllers\RestoreController::class, 'index']);
    Route::post('/check', [OZiTAG\Tager\Backend\User\Controllers\RestoreController::class, 'check']);
    Route::post('/complete', [OZiTAG\Tager\Backend\User\Controllers\RestoreController::class, 'complete']);
});
