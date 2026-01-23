<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ErrorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/errors', [ErrorController::class, 'index']);
    Route::post('/errors', [ErrorController::class, 'store']);
});
