<?php

namespace App\Http\Controllers;
use App\Models\Sponsor;
use App\Models\Order;
use App\Helpers\RaffleHelper;
use App\Models\Option;
use App\Models\Raffle;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function HomePage()
    {
        $raffles = RaffleHelper::getActiveRaffles();

        $array = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiempre","Octubre","Noviembre","Diciembre"];

        foreach($raffles as $i => $raffle){
            $raffle->queda = $this->getDisponibles($raffle);
            $raffle->barra = $this->getBarra($raffle)->barra;
            $raffle->mes = $array[date("n",strtotime($raffle->fecha_final)) - 1];
        }

        $data = [
            "BCV" => (Option::where("clave","BCV")->pluck("valor")->toArray())[0],
            "whatsapp" => (Option::where("clave","Whatsapp")->pluck("valor")->toArray())[0],
            "patrocinadores" => Sponsor::All(),
            "raffles" => $raffles,
        ];

        return view('home',$data);
    }

    public function HomeTest()
    {
        return view('welcome');
    }

    public function RafflePage(Raffle $raffle)
    {
        $currentRaffle = RaffleHelper::getCurrentRaffle();
        if($raffle->id > 0){
            $currentRaffle = $raffle;
        }
        

        if($currentRaffle == null){
            return redirect('/');
        }

        $disponibles = $this->getDisponibles($currentRaffle);

        $data = [
            "BCV" => (Option::where("clave","BCV")->pluck("valor")->toArray())[0],
            "Barra" => $this->getBarra($currentRaffle)->barra,
            "rifa" => $currentRaffle,
            "queda" => $disponibles
        ];
        
        return view('compra',$data);
    }

    public function Reporte(string $uuid)
    {
        Log::info('Orden para reporte uuid: '.$uuid);
        try{
            $order = Order::with("client","numbers")->where("uuid","=",$uuid)->first();
            $numbers = $order->numbers->pluck('numero_generado')->toArray();
            $data = [
                "order" => $order,
                "numbers" => $numbers,
                "from" => "url",
            ];
        } catch(Exception $e) {
            Log::error("Error para uuid {uuid} -> ".$e->getMessage(),["uuid"=>$uuid]);
        }
        return view('emails.purchase-approved',$data);
    }

    public function listadoTickets($raffleId)
    {
        $numeros = Order::with("numbers","client")->where("orders.estatus","=","1")->get();
        return view("listado",compact("numeros"));
    }

    private function getDisponibles($currentRaffle) {
        $orders = Order::where('orders.raffle_id', $currentRaffle->id)->where("estatus","<>","2");
        $total = $orders->sum('cantidad');
        return $total;
    }

    private function getBarra(Raffle $currentRaffle){
        return (DB::select("SELECT IFNULL(ROUND(100 - (sum(orders.cantidad) * 100 / raffles.cantidad_max),2),100) as barra from orders inner join raffles on raffles.id = orders.raffle_id where orders.estatus <> 2 and raffles.id = $currentRaffle->id"))[0];
    }

    public function Verificador(Request $request, Raffle $raffle)
    {
        $links = [];
        $cedula = $request->get("cedula") ?? 0;
        if(!empty($cedula) && $cedula != "0"){
            $links = Order::where("raffle_id", $raffle->id)
            ->select('orders.uuid','orders.estatus')
            ->join("clients","clients.id","=","orders.client_id")
            ->where("clients.cedula","=",$cedula)
            ->get();
        }
        
        $data = [
            "whatsapp" => (Option::where("clave","Whatsapp")->pluck("valor")->toArray())[0],
            "patrocinadores" => Sponsor::All(),
            "links" => $links,
            "raffle" => $raffle
        ];
        return view('verificador',$data);
    }
}