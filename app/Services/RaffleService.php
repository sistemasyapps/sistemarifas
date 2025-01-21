<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderDemo;
use App\Models\Raffle;
use Illuminate\Support\Facades\DB;

class RaffleService
{
    public function getDisponibles(Raffle $raffle)
    {
        $orders = OrderDemo::where('orders_demo.raffle_id', $raffle->id)
                       ->where("estatus","<>","2");
        return $orders->sum('cantidad');
    }

    public function getBarra(Raffle $raffle)
    {
        $tablaOrders="orders_demo";
        $tablaRaffles="raffles_demo";
        return DB::selectOne("
        SELECT IFNULL(ROUND(100 - (SUM(o.cantidad) * 100 / r.cantidad_max),2),100) AS barra
        FROM $tablaOrders o
        INNER JOIN $tablaRaffles r ON r.id = o.raffle_id
        WHERE o.estatus <> 2 AND r.id = ?
        GROUP BY r.id, r.cantidad_max
    ", [$raffle->id]);
    }
}
