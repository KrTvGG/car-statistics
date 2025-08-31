<?php

use App\Http\Controllers\GuidesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/guides', [GuidesController::class, 'index'])->name('guides.index');
    Route::post('/guides', [GuidesController::class, 'store'])->name('guides.create');

    Route::get('/test-route', [ApiController::class, 'helloWorld']);
    Route::post('/test-route', [ApiController::class, 'getAndTakeText']);
});
