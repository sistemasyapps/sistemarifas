<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use Filament\Resources\Pages\Page;
use App\Models\Raffle;
use Illuminate\Support\Facades\DB;

class Tickets extends Page
{
    protected static string $resource = TicketResource::class;

    protected static string $view = 'filament.resources.ticket-resource.pages.tickets';
    public $raffles = [];
    public $searched = [];

    public function mount()
    {
        $this->raffles = Raffle::all();

        $rifa = (int)($_GET["rifa"] ?? 0);
        $numeros = $_GET["nro_buscar"] ?? "";

        if($rifa > 0 && !empty($numeros)){
            $numerosArray = explode(',', $numeros);
            $numerosFinales = array_map(function($numero) {
                return preg_replace('/^0+/', '', trim($numero));
            }, $numerosArray);
            $numerosFinales = '"' . implode('","', $numerosFinales) . '"';

            $this->searched = DB::select("SELECT numero_generado,clients.*,order_numbers.created_at 
                FROM `order_numbers`
                inner join orders on orders.id = order_numbers.order_id
                inner join clients on clients.id = orders.client_id
                WHERE order_numbers.raffle_id = '$rifa' and numero_generado IN($numerosFinales) ");
        }
        
    }
}
