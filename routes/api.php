<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Facades\JWTAuth;

Route::middleware('api_guest')->group(function () {
    Route::post('login', [AuthController::class, "authenticate"])->name('login')->middleware('throttle:3,1');
});

Route::middleware("auth:api")->group(function() {
    Route::post('logout', [AuthController::class, "logout"])->name('logout');
});