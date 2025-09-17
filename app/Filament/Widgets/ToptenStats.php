<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
use App\Helpers\RaffleHelper;

class ToptenStats extends Widget
{
    protected static string $view = 'filament.widgets.topten-stats';

    protected function getViewData(): array
    {
        $currentRaffle = RaffleHelper::getActiveRaffles()[0] ?? null;

        if (! $currentRaffle) {
            return ['data' => []];
        }

        $top = DB::select("SELECT
            client_id, sum(cantidad) as tickets, UPPER(clients.nombre_completo) as nombre
        FROM
            orders
        INNER JOIN clients on clients.id = orders.client_id
        WHERE
            estatus = 1 and raffle_id = ".$currentRaffle->id."
        GROUP BY
            client_id
        ORDER BY
            tickets DESC
        limit 10");
        
        usort($top, fn ($a, $b) => $a->tickets < $b->tickets);
        
        return [
            'data' => $top,
        ];
    }
}
