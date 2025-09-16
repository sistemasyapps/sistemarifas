<?php

namespace App\Helpers;

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
            $ordenar = Option::where('clave', 'ordenar')->value('valor');
            $orden = (is_string($ordenar) && strtolower(trim($ordenar)) === 'si') ? 'asc' : 'desc';
            $query = Raffle::query();
            if (\Illuminate\Support\Facades\Schema::hasColumn('raffles', 'estatus')) {
                $query->where('estatus', 1);
            }
            return $query->orderBy('id', $orden)->get() ?: null;
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
