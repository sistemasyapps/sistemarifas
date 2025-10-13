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

        $staticData = $this->getHomeStaticData();

        $raffles->each(function($raffle) use ($rafflesData, $meses) {
            $barra = ($raffle->estatus_compra == 0) ? 0 : $rafflesData[$raffle->id];

            $raffle->queda = $rafflesData[$raffle->id] * 100;
            $raffle->barra = ($barra < 0.00) ? 0.00 : $barra;
            $raffle->mes = $meses[date("n", strtotime($raffle->fecha_final)) - 1];
            $raffle->sorteo_label = $raffle->mensaje_proximo_sorteo
                ?: ('Sorteo: ' . date('d', strtotime($raffle->fecha_final)) . ' ' . $raffle->mes);
        });

        return view('home', array_merge($staticData, [
            'raffles' => $raffles
        ]));
    }

    public function HomeNuevo()
    {
        $raffles = RaffleHelper::getActiveRaffles();
        $raffles = $raffles ? $raffles->values() : collect();

        $meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiempre","Octubre","Noviembre","Diciembre"];

        $rafflesData = $raffles->mapWithKeys(function($raffle) {
            return [$raffle->id => $this->getBarraOptimizado($raffle)];
        });

        $staticData = $this->getHomeStaticData();

        $enrichedRaffles = $raffles->map(function ($raffle, $index) use ($rafflesData, $meses) {
            $barra = $raffle->estatus_compra == 0
                ? 0
                : ($rafflesData[$raffle->id] ?? 0);

            $barra = max(0, min(100, $barra));
            $totalTickets = (int) ($raffle->cantidad_max ?? 0);
            $ticketsLeft = $totalTickets > 0
                ? (int) max(0, round(($barra / 100) * $totalTickets))
                : 0;
            $soldPercent = max(0, min(100, 100 - $barra));

            $raffle->queda = $ticketsLeft;
            $raffle->barra = $barra;
            $raffle->vendido = $soldPercent;
            $raffle->vendidos = $totalTickets > 0 ? max(0, $totalTickets - $ticketsLeft) : 0;
            $raffle->mes = $raffle->fecha_final
                ? $meses[date("n", strtotime($raffle->fecha_final)) - 1] ?? ''
                : '';
            $raffle->dia = $raffle->fecha_final ? date("d", strtotime($raffle->fecha_final)) : '';
            $raffle->sorteo_label = $raffle->mensaje_proximo_sorteo
                ?: ($raffle->dia && $raffle->mes
                    ? ('Sorteo: ' . $raffle->dia . ' ' . $raffle->mes)
                    : 'Próximo sorteo');
            $raffle->is_featured = $index === 0;
            $raffle->is_buyable = $raffle->estatus_compra == 1 && $ticketsLeft > 0;

            return $raffle;
        });

        return view('nuevo.nuevo', array_merge($staticData, [
            'featuredRaffle' => $enrichedRaffles->first(),
            'raffles' => $enrichedRaffles,
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

    protected function getHomeStaticData(): array
    {
        $cacheKey = 'home_static_data';
        $expiration = now()->addMinutes(1440);

        $staticData = Cache::get($cacheKey);

        if (! $this->isValidHomeStaticData($staticData)) {
            $staticData = $this->buildHomeStaticData();
            Cache::put($cacheKey, $staticData, $expiration);
        }

        return $staticData;
    }

    protected function isValidHomeStaticData($payload): bool
    {
        if (! is_array($payload)) {
            return false;
        }

        $requiredKeys = ['whatsapp', 'logo', 'patrocinadores', 'rrss', 'minimumTickets'];

        foreach ($requiredKeys as $key) {
            if (! array_key_exists($key, $payload)) {
                return false;
            }
        }

        return true;
    }

    protected function buildHomeStaticData(): array
    {
        $options = Option::all()->pluck('valor', 'clave');
        $whatsapp = $options->get('Whatsapp');
        $logo = $options->get('logo');
        $minimumTickets = max((int) ($options->get('cantidad_minima') ?? 1), 1);

        $patrocinadores = collect();
        if (Schema::hasTable('sponsors')) {
            $patrocinadores = Sponsor::query()->select('id', 'nombre', 'imagen')->get();
        }

        $rrss = collect();
        if (Schema::hasTable('rrsses') && Schema::hasColumn('rrsses', 'estatus')) {
            $rrss = Rrss::where('estatus', 1)->get(['id', 'tipo', 'link']);
        }

        return [
            'whatsapp' => $whatsapp,
            'logo' => $logo,
            'patrocinadores' => $patrocinadores,
            'rrss' => $rrss,
            'minimumTickets' => $minimumTickets,
        ];
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

    public function Verificador(Request $request, ?Raffle $raffle = null)
    {
        $cedula = trim((string) $request->get('cedula'));
        $hasSearch = $cedula !== '';

        $statusMap = [
            '0' => [
                'label' => 'En verificación',
                'variant' => 'warning',
                'message' => 'Tu pago está en revisión. Te avisaremos por correo y WhatsApp cuando termine la validación.',
            ],
            '1' => [
                'label' => 'Aprobada',
                'variant' => 'success',
                'message' => 'Tu compra fue aprobada. Descarga tus tickets para guardarlos con facilidad.',
            ],
            '2' => [
                'label' => 'Cancelada',
                'variant' => 'danger',
                'message' => 'La compra se canceló. Si crees que es un error, contáctanos para revisar el pago.',
            ],
            '9' => [
                'label' => 'Devuelta',
                'variant' => 'neutral',
                'message' => 'El monto fue devuelto al finalizar la investigación. Escríbenos si necesitas más detalles.',
            ],
            'default' => [
                'label' => 'Estado desconocido',
                'variant' => 'neutral',
                'message' => 'No pudimos identificar el estado de esta compra. Contáctanos para ayudarte.',
            ],
        ];

        $orders = collect();

        if ($hasSearch) {
            $orders = Order::with([
                    'raffle:id,nombre',
                    'numbers:order_id,numero_generado',
                ])
                ->whereHas('client', function ($query) use ($cedula) {
                    $query->where('cedula', $cedula);
                })
                ->when($raffle, function ($query) use ($raffle) {
                    $query->where('raffle_id', $raffle->id);
                })
                ->orderByDesc('created_at')
                ->get()
                ->map(function (Order $order) use ($statusMap) {
                    $status = $statusMap[$order->estatus] ?? $statusMap['default'];

                    $numbers = $order->numbers
                        ->pluck('numero_generado')
                        ->map(fn ($value) => trim((string) $value))
                        ->filter()
                        ->unique()
                        ->sort()
                        ->values()
                        ->all();

                    return [
                        'id' => $order->id,
                        'uuid' => $order->uuid,
                        'cantidad' => (int) $order->cantidad,
                        'created_at' => optional($order->created_at)->format('d/m/Y H:i'),
                        'status_code' => $order->estatus,
                        'status' => $status['label'],
                        'message' => $status['message'],
                        'variant' => $status['variant'],
                        'raffle' => $order->raffle?->nombre,
                        'numbers' => $numbers,
                    ];
                });
        }

        $options = Option::All()->pluck('valor', 'clave');
        $whatsapp = $options->get('Whatsapp');
        $logo = $options->get('logo');

        $data = [
            'whatsapp' => $whatsapp,
            'logo' => $logo,
            'patrocinadores' => Sponsor::All(),
            'orders' => $orders,
            'raffle' => $raffle,
            'cedula' => $cedula,
            'hasSearch' => $hasSearch,
            'rrss' => Rrss::where('estatus',1)->get(),
        ];

        return view('verificador', $data);
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
