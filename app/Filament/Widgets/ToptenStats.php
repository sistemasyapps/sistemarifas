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
        $activeRaffles = RaffleHelper::getActiveRaffles();

        if (! $activeRaffles || $activeRaffles->isEmpty()) {
            return ['raffles' => collect()];
        }

        return [
            'raffles' => $activeRaffles->map(function ($raffle) {
                $top = DB::select(
                    "SELECT
                        client_id,
                        SUM(orders.cantidad) AS tickets,
                        UPPER(clients.nombre_completo) AS nombre
                    FROM orders
                    INNER JOIN clients ON clients.id = orders.client_id
                    WHERE orders.estatus = 1 AND orders.raffle_id = ?
                    GROUP BY client_id, clients.nombre_completo
                    ORDER BY tickets DESC
                    LIMIT 10",
                    [$raffle->id]
                );

                return [
                    'raffle' => $raffle,
                    'data' => $top,
                ];
            }),
        ];
    }
}
