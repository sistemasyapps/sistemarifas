<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PreOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class R4WebhookController extends Controller
{
    // POST /R4consulta
    public function consulta(Request $request)
    {
        // PDF (R4consulta): { IdCliente, Monto, TelefonoComercio }
        $payload = $request->all();
        $idCliente = (string) data_get($payload, 'IdCliente', data_get($payload, 'Cedula'));
        $telefonoComercio = (string) data_get($payload, 'TelefonoComercio');
        $monto = data_get($payload, 'Monto');

        if ($idCliente === '' || $telefonoComercio === '' || $monto === null) {
            return response()->json(['status' => false, 'message' => 'Campos requeridos faltantes']);
        }

        if (!is_numeric($monto)) {
            return response()->json(['status' => false, 'message' => 'Monto inválido']);
        }

        $doc = preg_replace('/[^0-9]/', '', $idCliente);
        $tel = preg_replace('/[^0-9]/', '', $telefonoComercio);

        // Validación básica: teléfono de comercio debe tener 11 dígitos
        if (strlen($tel) !== 11) {
            return response()->json(['status' => false, 'message' => 'TelefonoComercio inválido']);
        }

        // Si se configuró el teléfono del comercio en .env, exigir coincidencia
        $expectedTel = preg_replace('/[^0-9]/', '', (string) env('R4_TELEFONO_COMERCIO', ''));
        if ($expectedTel !== '' && $expectedTel !== $tel) {
            return response()->json(['status' => false, 'message' => 'TelefonoComercio inválido']);
        }

        // Coincidencia contra pre-orders: cédula + monto exacto + vigencia 24h, excluyendo preórdenes con estatus asignado
        $query = PreOrder::where('cedula', $doc)
            ->whereNull('estatus_preorden')
            ->where('monto', round((float) $monto, 2))
            ->where('created_at', '>=', now()->subDay());

        $pre = $query->latest('id')->first();
        $hasMatch = (bool) $pre;

        // Guardar TelefonoComercio recibido si existe pre-orden coincidente
        if ($pre) {
            $pre->telefono_comercio = $tel;
            $pre->save();
        }

        return response()->json(['status' => $hasMatch]);
    }

    // POST /R4notifica
    public function notifica(Request $request)
    {
        // Payload (PDF - vía SIMF): IdComercio, TelefonoComercio, TelefonoEmisor, Concepto, BancoEmisor, Monto, FechaHora, Referencia, CodigoRed
        $payload = $request->all();
        $idComercio = (string) data_get($payload, 'IdComercio');
        $telefonoComercio = (string) data_get($payload, 'TelefonoComercio');
        $telefonoEmisor = (string) data_get($payload, 'TelefonoEmisor');
        $concepto = (string) data_get($payload, 'Concepto');
        $banco = (string) (data_get($payload, 'BancoEmisor') ?? data_get($payload, 'Banco'));
        $ref = (string) (data_get($payload, 'Referencia') ?? '');
        $monto = data_get($payload, 'Monto');
        $codigoRed = (string) (data_get($payload, 'CodigoRed') ?? data_get($payload, 'code'));
        $fechaHora = (string) (data_get($payload, 'FechaHora') ?? now()->toISOString());

        // Mapa de códigos a texto humano
        $codigos = [
            '00' => 'APROBADO',
            '01' => 'REFERIRSE AL CLIENTE',
            '12' => 'TRANSACCION INVALIDA',
            '13' => 'MONTO INVALIDO',
            '14' => 'NUMERO TELEFONO RECEPTOR ERRADO',
            '05' => 'TIEMPO DE RESPUESTA EXCEDIDO',
            '30' => 'ERROR DE FORMATO',
            '41' => 'SERVICIO NO ACTIVO',
            '43' => 'SERVICIO NO ACTIVO',
            '55' => 'TOKEN INVALIDO',
            '56' => 'CELULAR NO COINCIDE',
            '57' => 'NEGADA POR EL RECEPTOR',
            '62' => 'CUENTA RESTRINGIDA',
            '68' => 'RESPUESTA TARDIA, PROCEDE REVERSO',
            '80' => 'CEDULA O PASAPORTE ERRADO',
            '87' => 'TIME OUT',
            '90' => 'CIERRE BANCARIO EN PROCESO',
            '91' => 'INSTITUCION NO DISPONIBLE',
            '92' => 'BANCO RECEPTOR NO AFILIA',
        ];

        $ref8 = substr(preg_replace('/[^0-9]/', '', $ref), -8);
        $telCom = preg_replace('/[^0-9]/', '', $telefonoComercio);
        $telEmi = preg_replace('/[^0-9]/', '', $telefonoEmisor);
        // Validar teléfono de comercio si está configurado
        $expectedTel = preg_replace('/[^0-9]/', '', (string) env('R4_TELEFONO_COMERCIO', ''));
        if ($expectedTel !== '' && $expectedTel !== $telCom) {
            return response()->json(['abono' => false]);
        }

        // Si el código no es 00, actualizar (pendiente) y terminar
        if ($codigoRed !== '00') {
            // Buscar pre-orden por referencia si ya existe, o por monto + banco (3 últimos dígitos) + vigencia
            $banco3 = substr($banco, -3);
            $pre = null;
            if ($ref8 !== '') {
                $pre = PreOrder::where('ref_banco', $ref8)
                    ->where('telefono', $telEmi)
                    ->whereNull('estatus_preorden')
                    ->latest('id')->first();
            }
            if (!$pre) {
                $pre = PreOrder::query()
                    ->whereNull('estatus_preorden')
                    ->where('telefono', $telEmi)
                    ->where('monto', is_numeric($monto) ? round((float)$monto, 2) : -1)
                    ->where('bank_code_last3', $banco3)
                    ->where('created_at', '>=', now()->subDay())
                    ->latest('id')
                    ->first();
            }

            if ($pre) {
                // estatus_preorden ya fue filtrado (solo nulos). No reprocesar estados asignados
                $pre->codigo_red = $codigoRed;
                $pre->codigo_red_texto = $codigos[$codigoRed] ?? null;
                $pre->ref_banco = $ref8 ?: $pre->ref_banco;
                $pre->id_comercio = $idComercio ?: $pre->id_comercio;
                $pre->telefono_comercio = $telCom ?: $pre->telefono_comercio;
                $pre->telefono_emisor = preg_replace('/[^0-9]/', '', (string)$telefonoEmisor) ?: $pre->telefono_emisor;
                $pre->concepto = $concepto ?: $pre->concepto;
                $pre->banco_emisor = substr($banco ?? '', 0, 3) ?: $pre->banco_emisor;
                if (is_numeric($monto)) {
                    $pre->monto_notificado = round((float)$monto, 2);
                }
                $pre->fecha_hora = (strtotime($fechaHora) ? date('Y-m-d H:i:s', strtotime($fechaHora)) : now());
                $pre->save();
                // Establecer estatus interno pendiente_por_orden si aún no tiene
                if (empty($pre->estatus_preorden)) {
                    $pre->estatus_preorden = 'pendiente_por_orden';
                    $pre->save();
                }
                return response()->json(['abono' => true]);
            }
            return response()->json(['abono' => false]);
        }

        // No se procesan Orders en este flujo. Solo pre_ordenes.

        // 2) Marcar la pre_orden correspondiente (sin tocar Orders)
        // Criterio: referencia exacta (si pre ya la tiene, debe coincidir), monto exacto, banco emisor (3 últimos dígitos de bank_code), vigencia 24h
        $banco3 = substr($banco, -3);
        $pre = PreOrder::query()
            ->where('created_at', '>=', now()->subDay())
            ->whereNull('estatus_preorden')
            ->where('telefono', $telEmi)
            ->where('monto', is_numeric($monto) ? round((float)$monto, 2) : -1)
            ->where('bank_code_last3', $banco3)
            ->latest('id')
            ->first();

        if ($pre) {
            // Si la pre ya tiene referencia y no coincide, no avanzar a aprobación
            if (!empty($pre->ref_banco) && $pre->ref_banco !== $ref8) {
                $pre->codigo_red = $codigoRed;
                $pre->codigo_red_texto = $codigos[$codigoRed] ?? null;
                $pre->fecha_hora = (strtotime($fechaHora) ? date('Y-m-d H:i:s', strtotime($fechaHora)) : now());
                $pre->save();
                return response()->json(['abono' => false]);
            }

            // Persistir datos del payload
            $pre->ref_banco = $ref8 ?: $pre->ref_banco;
            $pre->codigo_red = $codigoRed ?: $pre->codigo_red;
            $pre->codigo_red_texto = $codigos[$codigoRed] ?? null;
            $pre->fecha_hora = (strtotime($fechaHora) ? date('Y-m-d H:i:s', strtotime($fechaHora)) : now());
            if (is_numeric($monto)) {
                $pre->monto_notificado = round((float)$monto, 2);
            }
            $pre->id_comercio = $idComercio ?: $pre->id_comercio;
            $pre->telefono_comercio = $telCom ?: $pre->telefono_comercio;
            $pre->telefono_emisor = preg_replace('/[^0-9]/', '', (string)$telefonoEmisor) ?: $pre->telefono_emisor;
            $pre->concepto = $concepto ?: $pre->concepto;
            $pre->banco_emisor = substr($banco ?? '', 0, 3) ?: $pre->banco_emisor;

            // Si hay una Order no aprobada con esta referencia, marcamos preorden como aprobada, si no, queda pendiente_por_orden
            $order = \App\Models\Order::where('ref_banco', $ref8)
                ->whereRaw('RIGHT(bank_code,3) = ?', [$banco3])
                ->whereHas('client', function($q) use ($telEmi) { $q->where('telefono', $telEmi); })
                ->where('estatus', '<>', '1')
                ->latest('id')
                ->first();
            if ($order) {
                $pre->estatus_preorden = 'aprobada';
                $pre->notificado = true;
                $pre->notificado_at = now();
                // Programar aprobación post-asignación de tickets
                try { \App\Jobs\ApproveOrderJob::dispatch($order->id)->delay(now()->addSeconds(5)); } catch (\Throwable $e) {}
            } else {
                $pre->estatus_preorden = 'pendiente_por_orden';
            }

            $pre->save();
            return response()->json(['abono' => true]);
        }

        Log::warning('R4notifica sin pre_orden u orden', ['Banco' => $banco, 'Referencia' => $ref8, 'Monto' => $monto]);
        return response()->json(['abono' => false]);
    }
}
