<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\PurchaseApproved;
use App\Models\Client;
use App\Models\Option;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class R4WebhookController extends Controller
{
    // POST /R4consulta
    public function consulta(Request $request)
    {
        // Expected minimal payload: { Cedula: "V12345678", Banco: "0105", Monto: 123.45 }
        $cedula = (string) data_get($request->all(), 'Cedula');
        if ($cedula === '') {
            return response()->json(['status' => false, 'message' => 'Cedula requerida']);
        }

        // Accept if there is at least one pending order for this client
        $client = Client::where('cedula', preg_replace('/[^0-9]/', '', $cedula))->first();
        if (!$client) {
            return response()->json(['status' => false, 'message' => 'Cliente no existe']);
        }

        $hasPending = Order::where('client_id', $client->id)
            ->where('estatus', '0')
            ->exists();

        return response()->json(['status' => $hasPending]);
    }

    // POST /R4notifica
    public function notifica(Request $request)
    {
        // Expected minimal payload: { Cedula, Banco, Referencia, Monto, code }
        $code = (string) data_get($request->all(), 'code');
        if ($code !== '00') {
            // Non-approved statuses are acknowledged without changes
            return response()->json(['message' => 'ack']);
        }

        $cedula = (string) data_get($request->all(), 'Cedula');
        $banco = (string) data_get($request->all(), 'Banco');
        $ref = (string) data_get($request->all(), 'Referencia');
        $monto = data_get($request->all(), 'Monto');

        $doc = preg_replace('/[^0-9]/', '', $cedula);
        $client = Client::where('cedula', $doc)->first();
        if (!$client) {
            return response()->json(['message' => 'ack']);
        }

        // Match pending order by cedula + bank_code + full reference
        $order = Order::where('client_id', $client->id)
            ->where('estatus', '0')
            ->where('bank_code', $banco)
            ->where('ref_banco', substr($ref, -8))
            ->latest('id')
            ->first();

        if (!$order) {
            Log::warning('R4notifica sin match', ['Cedula' => $cedula, 'Banco' => $banco, 'Referencia' => $ref]);
            return response()->json(['message' => 'ack']);
        }

        // Idempotency: if already approved, just ack
        if ($order->estatus === '1') {
            return response()->json(['message' => 'ack']);
        }

        $order->estatus = '1';
        if (is_numeric($monto)) {
            $order->monto_notificado_bs = $monto;
        }
        $order->fecha_pago_notificado = now();
        $order->save();

        // Optional email notify (reuses logic from existing approve flow)
        if (strtolower($order->client->correo) !== 'soporte@gmail.com') {
            try {
                $numbers = $order->numbers;
                $options = Option::all()->pluck('valor', 'clave');
                $logo = $options->get('logo');
                Mail::to($order->client->correo, $order->client->nombre_completo)
                    ->send(new PurchaseApproved($order, $numbers, $logo));
            } catch (\Throwable $e) {
                Log::error('Error enviando correo post-notifica: '.$e->getMessage());
            }
        }

        return response()->json(['message' => 'ok']);
    }
}

