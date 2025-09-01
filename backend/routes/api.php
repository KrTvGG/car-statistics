<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/test-route', [ApiController::class, 'helloWorld']);
    Route::post('/test-route', [ApiController::class, 'getAndTakeText']);
});
