<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\IncidentController;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->group(function () {
    Route::post("/auth/login", [AuthController::class, "login"])->name("login");

    Route::group([
        'middleware' => 'auth:api',
    ],
        function () {
            Route::post("/auth/register", [AuthController::class, "register"]);
            Route::apiResource("/incident", IncidentController::class);
        });
});
