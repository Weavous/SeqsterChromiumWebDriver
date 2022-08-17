<?php

use App\Http\Controllers\PatientTestResultWebDriverController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('web-driver')->group(function () {
    Route::prefix('patient')->group(function () {
        Route::get('documents/{login}', [PatientTestResultWebDriverController::class, 'show']);
        Route::post('documents', [PatientTestResultWebDriverController::class, 'store']);
    });
});
