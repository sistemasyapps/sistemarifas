<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Models\Raffle;
use App\Models\Option;
use Illuminate\Support\Facades\Cache;

class RaffleHelper
{
    public static function getCurrentRaffle() : object | null
    {
        // Obtener la rifa actual
        $raffle = Raffle::where('estatus', '=', 1)->first();

        // Retornar la rifa actual o null si no existe
        return $raffle ?: null;
    }

    public static function getActiveRaffles() : object | null
    {
        $raffle = Cache::rememberForever('active_raffle', function () {
            $ordernar = Option::where("clave","ordenar")->pluck("valor");
            $orden = ($ordernar[0] == "si") ? "asc" : "desc";
            return Raffle::with('orders')->where('estatus', 1)->orderBy("id",$orden)->get() ?: null;
        });

        return $raffle;
    }

    public static function getRaffle($id) : object | null
    {
        return Raffle::find($id) ?: null;
    }

    public static function getLastTen() : object | null
    {
        return Raffle::orderBy("id","desc")->take(10)->get();
    }
}
