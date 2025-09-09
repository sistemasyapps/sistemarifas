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
Route::post('/orderAdmin/{order}/approve', [OrderController::class, 'approve']);
Route::post('/orderAdmin/{order}/cancel', [OrderController::class, 'cancel']);
Route::post('/orderAdmin/{order}/returnOrder', [OrderController::class, 'returnOrder']);
Route::post('/orderAdmin/{order}/delete', [OrderController::class, 'delete']);
Route::post('/orderAdmin/{order}/modifyOrder', [OrderController::class, 'modifyOrder']);

Route::get('/getBarra/{raffle?}', [OrderController::class,'getBarra'])->name("barraRealTime");

Route::post('/uploadLogo', [UploadController::class, 'uploadLogo']);

Route::post('/toTopic/{token}', [FirebasePushController::class, 'toTopic']);
Route::get('/pruebaNotificaction', [FirebasePushController::class, 'testSending']);

// Pre-orden: crea registro previo para validación R4consulta
Route::post('/preOrder', [PreOrderController::class, 'create']);


// R4 Webhook endpoints (push flow)
Route::post('/R4consulta', [R4WebhookController::class, 'consulta'])->middleware(\App\Http\Middleware\R4Verify::class);
Route::post('/R4notifica', [R4WebhookController::class, 'notifica'])->middleware(\App\Http\Middleware\R4Verify::class);
