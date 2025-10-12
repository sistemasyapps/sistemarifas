<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\FirebasePushController;
use App\Http\Controllers\Api\R4WebhookController;
use App\Http\Controllers\Api\PreOrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/',function(Request $request) {
    echo 'Wokring';
});

Route::post('/orderCliente', [OrderController::class, 'create']);
Route::get('/order-status/{uuid}', [OrderController::class, 'status']);

Route::get('/getBarra/{raffle?}', [OrderController::class,'getBarra'])->name("barraRealTime");

Route::post('/uploadLogo', [UploadController::class, 'uploadLogo']);

Route::post('/toTopic/{token}', [FirebasePushController::class, 'toTopic']);
Route::get('/pruebaNotificaction', [FirebasePushController::class, 'testSending']);

// Pre-orden: crea registro previo para validación R4consulta
Route::post('/preOrder', [PreOrderController::class, 'create']);
Route::get('/preOrder/status/{uuid}', [PreOrderController::class, 'status']);


// R4 Webhook endpoints (push flow)
Route::post('/R4consulta', [R4WebhookController::class, 'consulta'])->middleware(\App\Http\Middleware\R4Verify::class);
Route::post('/R4notifica', [R4WebhookController::class, 'notifica'])->middleware(\App\Http\Middleware\R4Verify::class);
