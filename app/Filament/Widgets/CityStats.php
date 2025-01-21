<?php

// namespace App\Filament\Widgets;

// use Filament\Widgets\Widget;
// use Illuminate\Support\Facades\DB;

// class CityStats extends Widget
// {
//     protected static string $view = 'filament.widgets.city-stats';

//     protected function getViewData(): array
//     {
//         $data = DB::table('orders')
//             ->select(DB::raw('COUNT(*) as ordenes'), DB::raw('countries.name as pais'), DB::raw('regions.name as region'), DB::raw('cities.name as ciudad'))
//             ->join("cities","cities.id","=","orders.city_id")
//             ->join("regions","regions.id","=","cities.region_id")
//             ->join("countries","countries.id","=","regions.country_id")
//             ->where('estatus', 1)
//             ->groupBy(DB::raw('city_id'))
//             ->orderBy("ordenes","desc")
//             ->get()
//             ->toArray();
            
//         return [
//             'data' => $data,
//         ];
//     }
// }
