<?php

use App\Constants;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\IncidentController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function () {
    Route::post("/register", [AuthController::class, "register"])
        ->middleware(['auth:sanctum', 'role:' . Constants::ADMIN_ROLE . '|' . Constants::ROOT_ROLE]);
    Route::post("/login", [AuthController::class, "login"])->name("login");
    Route::post("/logout", [AuthController::class, "logout"])->middleware("auth:sanctum");
});

Route::prefix("v1")->group(function () {
    Route::middleware(['auth:sanctum', 'role:' . Constants::ADMIN_ROLE . '|' . Constants::ROOT_ROLE])->group(function () {
        Route::get("/users", [UserController::class, "index"]);
        Route::get("/user/{id}", [UserController::class, "show"]);
        Route::patch("/user/{id}", [UserController::class, "update"]);
        Route::put("/user/{id}", [UserController::class, "update"]);
        Route::delete("/user/{id}", [UserController::class, "destroy"]);

        Route::post("/user/assign-role", [UserController::class, "assignRoles"]);
        Route::post("/user/assign-permission", [UserController::class, "assignPermissions"]);
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::apiResource("/incidents", IncidentController::class);
    });
});
