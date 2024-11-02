<?php

use App\Constants;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\IncidentController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->group(function () {
    /*    =======  Auth  ======= */
    Route::prefix("auth")->group(function () {
        Route::post("/login", [AuthController::class, "login"])->name("login");
        Route::post("/register", [
            UserController::class, "store"
        ])->middleware(["auth:api, role:".Constants::ADMIN_ROLE."|".Constants::ROOT_ROLE]);
    });

    /*    =======  User  ======= */
    Route::middleware(["auth:api, role:".Constants::ADMIN_ROLE."|".Constants::ROOT_ROLE])->group(function () {
        Route::get("/user", [UserController::class, "index"]);
        Route::get("/user/{id}", [UserController::class, "show"]);
        Route::patch("/user/{id}", [UserController::class, "update"]);
        Route::put("/user/{id}", [UserController::class, "update"]);
        Route::delete("/user/{id}", [UserController::class, "destroy"]);
        Route::post("/user/assign-role", [UserController::class, "assignRoles"]);
        Route::post("/user/assign-permission", [UserController::class, "assignPermissions"]);
    })->middleware(['auth:api']);

    /*    =======  Incident  ======= */
    Route::middleware(["auth:api"])->group(function () {
        Route::apiResource("/incident", IncidentController::class);
    });
});
