<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class RegionStats extends Widget
{
    protected static string $view = 'filament.widgets.region-stats';

    protected function getViewData(): array
    {
        $data = DB::table('orders')
            ->select(DB::raw('COUNT(*) as ordenes'), DB::raw('countries.name as pais'), DB::raw('regions.name as region'))
            ->join("cities","cities.id","=","orders.city_id")
            ->join("regions","regions.id","=","cities.region_id")
            ->join("countries","countries.id","=","regions.country_id")
            ->where('estatus', 1)
            ->groupBy(DB::raw('regions.id'))
            ->orderBy("ordenes","desc")
            ->get()
            ->toArray();
        
        return [
            'data' => $data,
        ];
    }
}
