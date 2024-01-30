<?php

use App\Http\Controllers\Api\V1\IncidentController;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->group(function () {
    Route::apiResource("/incident", IncidentController::class);
});
