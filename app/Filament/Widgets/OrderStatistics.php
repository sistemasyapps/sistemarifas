<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
use App\Helpers\RaffleHelper;

class OrderStatistics extends Widget
{
    protected static string $view = 'filament.widgets.order-statistics';
    // public $data = [];

    protected function getViewData(): array
    {
        $activeRaffles = RaffleHelper::getActiveRaffles();

        if (! $activeRaffles || $activeRaffles->isEmpty()) {
            return [
                'data' => [],
                'total' => [],
            ];
        }

        $data = [];
        $total = [];

        foreach ($activeRaffles->pluck('id') as $raffleId)
        {
             $tmp = DB::table('orders')
                ->select(DB::raw("raffles.nombre"),DB::raw("raffles.id"),DB::raw('DATE(orders.created_at) as dia'), DB::raw('COUNT(orders.id) as ordenes'), DB::raw('SUM(cantidad) as total'))
                ->join("raffles","raffles.id","=","orders.raffle_id")
                ->where('raffle_id', $raffleId)
                ->where('orders.estatus', "1")
                ->groupBy(DB::raw('raffle_id,DATE(orders.created_at)'))
                ->get()
                ->toArray();
            $data[] = $tmp;
            $total[] = array_sum(array_column($tmp,"total"));
        }

        return [
            'data' => $data, 
            'total' => $total
        ];
    }

    private function responseViewData($data, $total, $raffle)
    {
        return [
            'data' => $data, 
            'raffle' => $raffle,
            'total' => $total
        ];
    }
}
