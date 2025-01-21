<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Models\Raffle;

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
        return Raffle::where('estatus', 1)->orderBy("id","desc")->get() ?: null;
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
