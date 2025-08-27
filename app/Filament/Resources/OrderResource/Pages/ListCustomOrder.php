<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\Page;
use App\Models\Order;
use App\Models\OrderNumber;
use Illuminate\Support\Facades\DB;
use App\Helpers\RaffleHelper;

class ListCustomOrder extends Page
{
    protected static string $resource = OrderResource::class;

    protected static string $view = 'filament.resources.order-resource.pages.list-custom-order';

    public $records = [];
    public $allRaffles = [];

    public function mount()
    {
        $this->allRaffles = RaffleHelper::getLastTen();

        $estatus = $_GET["estatus"] ?? 0;
        $raffleId = $_GET["rifa_select"] ?? $this->allRaffles[0]->id;

        $this->records = Order::with("client","raffle")
        ->selectRaw('orders.*, (SELECT COUNT(*) FROM orders as o2 WHERE o2.ref_banco = orders.ref_banco AND o2.raffle_id = orders.raffle_id) as ref_repetido')
        ->where("estatus",$estatus)
        ->where("raffle_id",$raffleId)
        ->get();
        
    }
}
