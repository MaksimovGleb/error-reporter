<?php

use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('errors.index');
});

Route::resource('errors', ErrorController::class)->only(['index', 'create', 'store']);
