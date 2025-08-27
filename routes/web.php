<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\WebsiteTestController;
use App\Models\Order;
use App\Jobs\CreateTickets;

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

Route::get('/home', [WebsiteController::class,'HomeNuevo'])->name("login");
Route::get('/',[WebsiteController::class,'HomeNuevo'])->name("home");
Route::get('/nuevo',[WebsiteController::class,'HomeNuevo'])->name("home_nuevo");
Route::get('/test',[WebsiteController::class,'HomeTest'])->name("test");
Route::get('/ticket/{uuid}',[WebsiteController::class,'Reporte'])->name("reporte");
Route::get('/orden/{uuid}',[WebsiteController::class,'Reporte']);
Route::get('/compra/{raffle?}', [WebsiteController::class,'RafflePage'])->name("compra");
Route::get('/compraTest/{raffle?}', [WebsiteTestController::class,'RafflePage'])->name("compraTest");
Route::get('/listadoTickets/{raflle}',[WebsiteController::class,'listadoTickets'])->middleware('auth');
Route::get('/topten',[OrderController::class,'getTopTen'])->middleware('auth');
Route::get('/verificador/{raffle?}',[WebsiteController::class,'Verificador'])->name("verificador");

Route::get('/generar/{id?}',function(Request $request, $id){
    $orders = Order::with("raffle")
    ->select("orders.*")
    ->leftJoin("order_numbers","order_numbers.order_id","=","orders.id")
    ->where("orders.estatus","<>","2")
    ->where("orders.raffle_id","=",$id)
    ->whereNull("order_numbers.id")
    ->get();

    echo count($orders)."<hr>";

    foreach($orders as $i => $order) {
       CreateTickets::dispatch($order);
       sleep(1);
       echo "orden: ".$order->id." Generada <br>";
    }
});
