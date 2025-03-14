<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\PurchaseApproved;
use App\Mail\OrderCreated;
use App\Models\Client;
use App\Models\Raffle;
use App\Helpers\RaffleHelper;
use App\Models\Option;
use App\Models\Order;
use App\Models\Country;
use App\Models\Region;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use GuzzleHttp\Client as GClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request as GRequest;
use Exception;

class OrderController extends Controller
{

    private function getDisponibles($raffle_id) {
        $orders = Order::where('orders.raffle_id', $raffle_id)->where("estatus","<>","2");
        $total = $orders->sum('cantidad');
        return $total;
    }

    public function create(Request $request)
    {
        $success = true;
        Log::info('Empieza el crear, antes de las validaciones');

        $validator = Validator::make($request->all(), [
            'raffle_id' => 'required',
            'cedula' => 'required',
            'nombre_completo' => 'required',
            'correo' => 'required',
            'tlf' => 'required',
            'cantidad' => 'required',
            // 'ref_banco' => 'required',
            'ref_imagen' => 'required',
            // 'ref_fecha' => 'required',
        ]);

        Log::info('Empieza el crear, despues de las validaciones');

        if ($validator->fails()) {
            $errores = json_encode($validator->errors());
            $postData = json_encode($_POST);
            Log::error("Fallo de validacion: ".$errores." postData:".$postData);
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        Log::info('Paso las validaciones');

        $datosCliente = [
            'cedula' => $request->cedula,
            'nombre_completo' => $request->nombre_completo,
            'correo' => $request->correo,
            'telefono' => $request->tlf,
        ];

        try{
            Log::info('Intenta buscar el cliente {cedula}',["cedula" => $request->cedula]);
            $cliente = Client::where('cedula', $request->cedula)->first();
            if (!$cliente) {
                Log::info('Intenta crear el cliente {cedula}, {nombre_completo}, {correo}, {telefono}',$datosCliente);
                $cliente = Client::create($datosCliente);
            }
        } catch(Exception $e) {
            Log::info('Entro por el error de crear cliente');
            Log::error("Crear cliente error -> {cedula}, {nombre_completo}, {correo}, {telefono} -> ".$e->getMessage(),$datosCliente);
            return response()->json([
                'success' => false
            ], 422);
        }

        Log::info('Empieza a crear datos personalizados para la orden');

        $data = $request->all();
        $data["uuid"] = Str::uuid()->toString();
        $data['client_id'] = $cliente->id;
        $data['estatus'] = '0';
        $data['precio_dolar'] = (Option::where("clave","BCV")->pluck("valor")->toArray())[0];
        $data['ref_imagen'] = $request->file('ref_imagen')->store('images', 'public');

        if(in_array($data["cedula"], ["12345678","1234","351846","3255855","3265329","84332669","123456789","12345679","53255555","56532642","123456790"])){
            return response()->json([
                'success' => false,
                'message' => 'Ya la policia tiene su dirección San Carlos, Cojedes, 9.6612,-68.5827 IP: 2803:c000:e:6f3d:212c:543f:8968:d056, 2803:c000:e:6f3d:d0c6:7bff:fe41:603c'
            ], 422);
        }


        $repetido = Order::where('client_id','=',$cliente->id)
        ->where('ref_banco','=',$data['ref_banco'])
        ->where('raffle_id','=',$data['raffle_id'])
        ->exists();
        if($repetido) {
            return response()->json([
                'success' => false,
                'message' => 'Esta compra esta repetida'
            ], 422);
        }

        $disponibles = $this->getDisponibles($data['raffle_id']);

        if($disponibles >= 9999) {
            return response()->json([
                'success' => false,
                'message' => 'Tickets agotados, por favor escriba a soporte para la devolucion de su dinero'
            ], 422);
        }

        try{
            // $data['IP'] = $request->ipinfo->ip;
            $data['IP'] = $request->ip();
        } catch(Exception $e) {
            $data['IP'] = "181.208.247.65";
        }

        try{
            Log::info('Obteniendo datos de la IP -> Pais');
            // $country_id = $this->getOrCreateCountry($request->ipinfo->country_name);
            $country_id = 1;
        } catch(Exception $e) {
            $country_id = 1;
            Log::error("Obtener pais error");
        }

        try{
            Log::info('Obteniendo datos de la IP -> Region');
            // $region_id = $this->getOrCreateRegion($request->ipinfo->region,$country_id);
            $region_id = 1;
        }catch(Exception $e) {
            $region_id = 1;
            Log::error("Obtener region error");
        }

        try{
            Log::info('Obteniendo datos de la IP -> City');
            // $city_id = $this->getOrCreateCity($request->ipinfo->city,$region_id);
            $city_id = 1;
        }catch(Exception $e) {
            $city_id = 1;
            Log::error("Obtener ciudad error");
        }

        $data['city_id'] = $city_id;
        Log::info('Terminar de crear datos personalizados para la orden');
        

        try{
            Log::info('Intenta crear la orden');
            $order = Order::create($data);
        } catch(Exception $e) {
            Log::info('Entro por el error de crear la orden');
            Log::error("Crear orden error -> cliente {id} -> ".$e->getMessage(),["id"=>$cliente->id]);
            return response()->json([
                'success' => false
            ], 422);
        }

        try{
            Log::info('Intenta enviar el correo encolado');
            Mail::to($cliente->correo)->send(new OrderCreated($order));
        } catch(Exception $e) {
            Log::info('Error al enviar el correo');
            Log::error("Error al enviar el correo ".$e->getMessage());
        }

        Log::info('Termina la creacion de datos');

        return response()->json([
            'success' => true,
            'msg' => 'Compra creada exitosamente',
            'date' => date("d-m-Y h:i:s"),
            'compra' => $order
        ], 201);
    }

    public function cancel(Request $request, Order $order)
    {
        $order->estatus = '2';
        $order->save();

        return response()->json([
            'success' => true,
            'msg' => 'Order cancelada exitosamente.'
        ]);
    }

    public function delete(Request $request, Order $order)
    {
        $order->delete();

        return response()->json([
            'success' => true,
            'msg' => 'Order eliminada exitosamente.'
        ]);
    }

    public function approve(Request $request, Order $order)
    {
        if ($order->estatus === '1') {
            return response()->json([
                'success' => false, 
                'message' => 'La orden ya ha sido aprobada.'
            ]);
        }

        $startTime = microtime(true);
        $order->estatus = '1';
        $order->save();

        $numbers = $this->generateUniqueNumber($order->raffle_id, $order->cantidad, $order->raffle->cantidad_max);

        foreach ($numbers as $number) {
            $order->numbers()->create([
                'numero_generado' => $number,
                'raffle_id'=> $order->raffle_id
            ]);
        }
        
        try{
            Mail::to($order->client->correo)->send(new PurchaseApproved($order, $numbers));
            Log::info('Correo enviado...');
        } catch(Exception $e) {
            Log::error("Error al enviar Correos".$e->getMessage(),$dataWhatsapp);
        }

        try{
            $messageWhatsapp = "!Hola ".$order->client->nombre_completo."! Tu compra [#".$order->id."] ha sido aprobada, puedes ver tu compra en el siguiente enlace, https://ganaconandreaaular.com/orden/".$order->uuid;
            Log::info("Mensaje de Whatsapp -> ".$messageWhatsapp);
            $dataWhatsapp = [
                "to" => $this->normalizarTelefono($order->client->telefono),
                "message" => $messageWhatsapp,
            ];
            $this->sendWhatsapp($dataWhatsapp);
        } catch(Exception $e) {
            Log::error("Error al enviar Whatsapp {to} {message} -> ".$e->getMessage(),$dataWhatsapp);
        }

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

        return response()->json([
            'success' => true,
            'msg' => 'Compra aprobada', 
            'execution_time' => $executionTime
        ]);
    }

    private function normalizarTelefono($telefono) {
        $telefonoParsed = preg_replace('/[^0-9]/', '', $telefono);
        
        if (substr($telefono, 0, 1) === '+') {
            return "+".$telefonoParsed;
        }
      
        return '+58' . $telefonoParsed;
    }

    private function sendWhatsapp($datos)
    {
        try{
            $client = new GClient();
            $headers = [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ];
            $params=array(
                'token' => "jus61xbpgl8jczwh",
                'to' => $datos['to'],
                'body' => $datos['message']
            );
            $options = ['form_params' =>$params ];
            $request = new GRequest(
                method: 'POST',
                uri: "https://api.ultramsg.com/instance102115/messages/chat",
                headers: $headers
            );
            $res = $client->sendAsync($request, $options)->wait();
            Log::info('Envio del whatsapp: '.$res->getBody());
        }catch(RequestException $e) {
            Log::error("Fallo envio del whatsapp: ".$e->getMessage());
        }
    }

    public function generateUniqueNumber($rifaId, $cantidad, $cantidadMax)
    {
        $existingNumbers = DB::table('order_numbers')
            ->join('orders', 'orders.id', '=', 'order_numbers.order_id')
            ->where('orders.raffle_id', $rifaId)
            ->pluck('order_numbers.numero_generado')
            ->toArray();
        
        $numbers = range(0,$cantidadMax - 1);
        $allowNumbers = array_diff($numbers,$existingNumbers);
        shuffle($allowNumbers);
        return array_slice($allowNumbers,0,$cantidad);
    }

    private function getOrCreateCountry(string $countryName)
    {
        $country = Country::firstWhere('name', $countryName);
        if($country)
        {
            return $country->id;
        }

        $country = Country::updateOrCreate([
            'name' => $countryName
        ]);

        return $country->id;
    }

    private function getOrCreateRegion(string $regionName, int $country_id)
    {
        $region = Region::firstWhere('name', $regionName);
        if($region)
        {
            return $region->id;
        }

        $region = Region::updateOrCreate([
            'name' => $regionName,
            'country_id' => $country_id
        ]);

        return $region->id;
    }

    private function getOrCreateCity(string $cityName, int $region_id)
    {
        $region = City::firstWhere('name', $cityName);
        if($region)
        {
            return $region->id;
        }

        $region = City::updateOrCreate([
            'name' => $cityName,
            'region_id' => $region_id
        ]);

        return $region->id;
    }

     public function getBarra(Raffle $raffle){
        // $currentRaffle = RaffleHelper::getActiveRaffles()[0];
        // if($raffle->id > 0){
            $currentRaffle = $raffle;
        // }
        // return (DB::select("SELECT valor as barra from options where clave='progress-bar'"))[0];
        $datos = (DB::select("SELECT
            raffle_id,
            IFNULL(
                ROUND(100 - (sum(orders.cantidad) * 100 / raffles.cantidad_max), 2),
                100
            ) AS barra
        FROM orders
        INNER JOIN raffles ON raffles.id = orders.raffle_id
        WHERE orders.estatus <> 2
        GROUP BY raffle_id;"))[0];
        $quedan = $currentRaffle->cantidad_max - $this->getDisponibles($currentRaffle->id);
        return response()->json([
            'barra' => $datos->barra,
            'queda' => $quedan
        ], 206);
    }
}
