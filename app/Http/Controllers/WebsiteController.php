<?php

namespace App\Http\Controllers;
use App\Models\Sponsor;
use App\Models\Order;
use App\Helpers\RaffleHelper;
use App\Models\Option;
use App\Models\Raffle;
use App\Models\MetodoPago;
use App\Models\Rrss;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class WebsiteController extends Controller
{
    public function HomePage()
    {
        $raffles = RaffleHelper::getActiveRaffles();

        $meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiempre","Octubre","Noviembre","Diciembre"];

        $rafflesData = $raffles->mapWithKeys(function($raffle) {
            return [$raffle->id => $this->getBarraOptimizado($raffle)];
        });

        $staticData = Cache::remember('home_static_data', 1440, function() {
            $options = Option::All()->pluck('valor', 'clave');
            $whatsapp = $options->get('Whatsapp');
            $logo = $options->get('logo');

            return [
                'whatsapp' => $whatsapp,
                'logo' => $logo,
                'patrocinadores' => Sponsor::all(['id', 'nombre', 'imagen']),
                'rrss' => Rrss::where("estatus",1)->get(['id', 'tipo', 'link'])
            ];
        });

        $raffles->each(function($raffle) use ($rafflesData, $meses) {
            $barra = ($raffle->estatus_compra == 0) ? 0 : $rafflesData[$raffle->id];

            $raffle->queda = $rafflesData[$raffle->id] * 100;
            $raffle->barra = ($barra < 0.00) ? 0.00 : $barra;
            $raffle->mes = $meses[date("n", strtotime($raffle->fecha_final)) - 1];
        });

        return view('home', array_merge($staticData, [
            'raffles' => $raffles
        ]));
    }

    public function HomeNuevo()
    {
        $raffles = RaffleHelper::getActiveRaffles();
        $currentRaffle = $raffles->first();
        $remainingRaffles = array_slice($raffles->toArray(), 1);

        $meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiempre","Octubre","Noviembre","Diciembre"];

        $rafflesData = $raffles->mapWithKeys(function($raffle) {
            return [$raffle->id => $this->getBarraOptimizado($raffle)];
        });

         $staticData = Cache::remember('home_static_data', 1440, function() {
            $options = Option::all()->pluck('valor', 'clave');
            $whatsapp = $options->get('Whatsapp');
            $logo = $options->get('logo');

            $patrocinadores = collect();
            if (Schema::hasTable('sponsors')) {
                $patrocinadores = Sponsor::query()->select('id','nombre','imagen')->get();
            }

            $rrss = collect();
            if (Schema::hasTable('rrsses') && Schema::hasColumn('rrsses','estatus')) {
                $rrss = Rrss::where('estatus',1)->get(['id','tipo','link']);
            }

            return [
                'whatsapp' => $whatsapp,
                'logo' => $logo,
                'patrocinadores' => $patrocinadores,
                'rrss' => $rrss,
            ];
        });

        $raffles->each(function($raffle) use ($rafflesData, $meses) {
            $barra = ($raffle->estatus_compra == 0) ? 0 : $rafflesData[$raffle->id];

            $raffle->queda = $rafflesData[$raffle->id] * 100;
            $raffle->barra = ($barra < 0.00) ? 0.00 : $barra;
            $raffle->mes = $meses[date("n", strtotime($raffle->fecha_final)) - 1];
            $raffle->dia = date("d", strtotime($raffle->fecha_final));
        });

        return view('nuevo.nuevo', array_merge($staticData, [
            'raffle' => $currentRaffle,
            'raffles' => $remainingRaffles
        ]));
    }

    public function HomeTest()
    {
        return view('welcome');
    }

    public function RafflePage(Raffle $raffle)
    {
        $currentRaffle = RaffleHelper::getCurrentRaffle();
       
        $isLogged = false;
        $show = false;

        if (Auth::check()) {
            $isLogged = true;
        }

         if($raffle->id > 0){
            $currentRaffle = $raffle;
        }

        if($currentRaffle == null){
            return redirect('/');
        }

        $disponibles = $this->getDisponibles($currentRaffle);

        if( ($disponibles < 9999 && $currentRaffle->estatus_compra == 1) || $isLogged) {
            $show = true;
        }

        $options = Option::All()->pluck('valor', 'clave');
        $logo = $options->get('logo');
        $bcv = $options->get('BCV');
        $cantidad_minima = $options->get('cantidad_minima');

        $data = [
            "BCV" => $bcv,
            "cantidad_minima" => $cantidad_minima,
            "logo" => $logo,
            "Barra" => $this->getBarra($currentRaffle)->barra,
            "metodos" => MetodoPago::where("estatus",1)
                ->orderBy('orden')
                ->orderBy('id')
                ->get(),
            "rifa" => $currentRaffle,
            "queda" => $currentRaffle->estatus_compra == 1 ? $disponibles : 0,
            "logged" => $isLogged
        ];
        
        return view('compra',$data);
    }

    public function Reporte(string $uuid)
    {
        $options = Option::All()->pluck('valor', 'clave');
        $logo = $options->get('logo');
        Log::info('Orden para reporte uuid: '.$uuid);
        try{
            $order = Order::with("client","numbers")->where("uuid","=",$uuid)->first();
            $numbers = $order->numbers;
            $data = [
                "order" => $order,
                "numbers" => $numbers,
                "logo" => $logo,
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
        
        $options = Option::All()->pluck('valor', 'clave');
        $whatsapp = $options->get('Whatsapp');
        $logo = $options->get('logo');

        $data = [
            "whatsapp" => $whatsapp,
            "logo" => $logo,
            "patrocinadores" => Sponsor::All(),
            "links" => $links,
            "raffle" => $raffle,
            "rrss" => Rrss::where("estatus",1)->get(),
        ];
        return view('verificador',$data);
    }

    private function getBarraOptimizado(Raffle $currentRaffle){
    
        $cacheKey = "raffle_progress_{$currentRaffle->id}";

        return Cache::remember($cacheKey, now()->addMinutes(1), function () use ($currentRaffle) {
            $percentage = DB::table('orders')
                ->where('raffle_id', $currentRaffle->id)
                ->where('estatus', '<>', 2)
                ->sum('cantidad');

            if ($currentRaffle->cantidad_max <= 0) {
                return 100;
            }

            $progress = 100 - (($percentage * 100) / $currentRaffle->cantidad_max);
            
            return round($progress, 2);
        });
    }
}
