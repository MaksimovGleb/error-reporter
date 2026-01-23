<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ErrorMessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/error-messages', [ErrorMessageController::class, 'index']);
    Route::post('/error-messages', [ErrorMessageController::class, 'store']);
});
