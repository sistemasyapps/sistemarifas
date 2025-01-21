<?php

namespace App\Http\Controllers;

use App\Helpers\RaffleHelper;
use App\Models\Option;
use App\Models\Raffle;
use App\Services\RaffleService;
use Illuminate\Http\Request;

class WebsiteTestController extends Controller
{
    protected $raffleService;

    public function __construct(RaffleService $raffleService)
    {
        $this->raffleService = $raffleService;
    }

    public function RafflePage(Raffle $raffle = null)
    {
        $currentRaffle = RaffleHelper::getCurrentRaffle();
        if($raffle->id > 0){
            $currentRaffle = $raffle;
        }
        

        if($currentRaffle == null){
            return redirect('/');
        }

        $disponibles = $this->raffleService->getDisponibles($raffle);
        $barraObj = $this->raffleService->getBarra($raffle);

        $data = [
            "BCV"     => Option::where("clave","BCV")->value("valor"),
            "Barra"   => $barraObj->barra,
            "rifa"    => $raffle,
            "queda"   => $disponibles
        ];

        return view('compra_test', $data);
    }
}
