<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api_guest')->group(function () {
    Route::post('login', [AuthController::class, "authenticate"])->name('login')->middleware('throttle:3,1');
});

Route::middleware("auth:api")->group(function() {

});