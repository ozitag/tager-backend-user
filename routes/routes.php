<?php

use Illuminate\Support\Facades\Route;

use OZiTAG\Tager\Backend\User\Controllers\RestoreController;

Route::group(['prefix' => 'tager/restore', 'middleware' => ['passport:users']], function () {
    Route::post('/', [RestoreController::class, 'index']);
    Route::post('/check', [RestoreController::class, 'check']);
    Route::post('/complete', [RestoreController::class, 'complete']);
});
