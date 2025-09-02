<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\PurchaseApproved;
use App\Models\Client;
use App\Models\PreOrder;
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
        // Expected payload: { Cedula: "V12345678", Banco: "0105", Monto: 123.45 }
        $cedula = (string) data_get($request->all(), 'Cedula');
        $banco = (string) data_get($request->all(), 'Banco');
        $monto = data_get($request->all(), 'Monto');

        if ($cedula === '' || $banco === '' || $monto === null) {
            return response()->json(['status' => false, 'message' => 'Campos requeridos faltantes']);
        }

        if (!is_numeric($monto)) {
            return response()->json(['status' => false, 'message' => 'Monto inválido']);
        }

        $doc = preg_replace('/[^0-9]/', '', $cedula);

        // Match against pre-orders: cedula + bank_code + monto exacto
        // Solo considerar pre-órdenes vigentes (últimas 24 horas)
        $hasMatch = PreOrder::where('cedula', $doc)
            ->where('bank_code', $banco)
            ->where('monto', round((float) $monto, 2))
            ->where('created_at', '>=', now()->subDay())
            ->exists();

        return response()->json(['status' => $hasMatch]);
    }

    // POST /R4notifica
    public function notifica(Request $request)
    {
        // Expected payload (según doc): BancoEmisor, Referencia, Monto, CodigoRed, FechaHora
        // Mantener compatibilidad con claves actuales
        $banco = (string) (data_get($request->all(), 'BancoEmisor') ?? data_get($request->all(), 'Banco'));
        $ref = (string) (data_get($request->all(), 'Referencia') ?? '');
        $monto = data_get($request->all(), 'Monto');
        $codigoRed = (string) (data_get($request->all(), 'CodigoRed') ?? data_get($request->all(), 'code'));
        $fechaHora = (string) (data_get($request->all(), 'FechaHora') ?? now()->toISOString());

        if ($codigoRed !== '00') {
            return response()->json(['abono' => false]);
        }

        $ref8 = substr(preg_replace('/[^0-9]/', '', $ref), -8);

        // 1) Intentar aprobar una Order pendiente ya creada (flujo original)
        $order = Order::where('estatus', '0')
            ->where('bank_code', $banco)
            ->where('ref_banco', $ref8)
            ->latest('id')
            ->first();

        if ($order) {
            if ($order->estatus !== '1') {
                $order->estatus = '1';
                if (is_numeric($monto)) {
                    $order->monto_notificado_bs = $monto;
                }
                $order->fecha_pago_notificado = now();
                $order->save();

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
            }
            return response()->json(['abono' => true]);
        }

        // 2) Si aún no hay Order (usuario no terminó formulario), marcar la pre_orden
        $pre = PreOrder::where('bank_code', $banco)
            ->where('monto', is_numeric($monto) ? round((float) $monto, 2) : -1)
            ->latest('id')
            ->first();

        if ($pre) {
            $pre->notificado = true;
            $pre->notificado_at = now();
            $pre->ref_banco = $ref8 ?: $pre->ref_banco;
            $pre->codigo_red = $codigoRed ?: $pre->codigo_red;
            $pre->fecha_hora = now();
            if (is_numeric($monto)) {
                $pre->monto_notificado = round((float) $monto, 2);
            }
            $pre->save();
            return response()->json(['abono' => true]);
        }

        Log::warning('R4notifica sin pre_orden u orden', ['Banco' => $banco, 'Referencia' => $ref8, 'Monto' => $monto]);
        return response()->json(['abono' => false]);
    }
}
