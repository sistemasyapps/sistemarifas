<?php

use App\Http\Controllers\Api\OrderController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/orderCliente', [OrderController::class, 'create']);
Route::post('/orderAdmin/{order}/approve', [OrderController::class, 'approve']);
Route::post('/orderAdmin/{order}/cancel', [OrderController::class, 'cancel']);
Route::post('/orderAdmin/{order}/delete', [OrderController::class, 'delete']);
Route::get('/getBarra/{raffle?}', [OrderController::class,'getBarra'])->name("barraRealTime");