<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/get-order', [\App\Http\Controllers\ApiOrderController::class, 'newOrder']);

Route::get('/update-dash', [\App\Http\Controllers\ApiOrderController::class, 'checkBoard']);

Route::get('/get-comment', [\App\Http\Controllers\ApiOrderController::class, 'getOrderComment']);


Route::get('/update-send', [\App\Http\Controllers\ApiOrderController::class, 'updateOrderToUser']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
