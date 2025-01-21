<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\WebsiteTestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', [WebsiteController::class,'HomePage'])->name("login");
Route::get('/',[WebsiteController::class,'HomePage'])->name("home");
Route::get('/test',[WebsiteController::class,'HomeTest'])->name("test");
Route::get('/ticket/{uuid}',[WebsiteController::class,'Reporte'])->name("reporte");
Route::get('/orden/{uuid}',[WebsiteController::class,'Reporte']);
Route::get('/compra/{raffle?}', [WebsiteController::class,'RafflePage'])->name("compra");
Route::get('/compraTest/{raffle?}', [WebsiteTestController::class,'RafflePage'])->name("compraTest");
Route::get('/listadoTickets/{raflle}',[WebsiteController::class,'listadoTickets'])->middleware('auth');
Route::get('/topten',[OrderController::class,'getTopTen'])->middleware('auth');
Route::get('/verificador/{raffle?}',[WebsiteController::class,'Verificador'])->name("verificador");
