<?php

use App\Http\Controllers\TaskController;
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

Route::prefix('v1')
    ->group(function () {
        Route::apiResource('tasks', TaskController::class);
    });

Route::fallback(function () {
    return response()->json([
        'status' => 404,
        'error' => 'Not Found',
        'message' => 'Unknown URL requested',
    ], 404);
});
