<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PreOrder;
use App\Models\MetodoPago;
use App\Models\NotificacionBanco;
use App\Models\NotificacionBancoConsulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class R4WebhookController extends Controller
{
    // POST /R4consulta
    public function consulta(Request $request)
    {
        $this->storeRawBancoPayload((string) $request->getContent(), true);

        // PDF (R4consulta): { IdCliente, Monto, TelefonoComercio }
        $payload = $request->all();
        $idCliente = (string) data_get($payload, 'IdCliente', data_get($payload, 'Cedula'));
        $telefonoComercio = (string) data_get($payload, 'TelefonoComercio');
        $monto = data_get($payload, 'Monto');

        if ($idCliente === '' || $telefonoComercio === '' || $monto === null) {
            // echo 'problema 1';
            return response()->json(['status' => false, 'message' => 'Campos requeridos faltantes']);
        }

        if (!is_numeric($monto)) {
            // echo 'problema 3';
            return response()->json(['status' => false, 'message' => 'Monto inválido']);
        }

        $doc = preg_replace('/[^0-9]/', '', $idCliente);
        $tel = preg_replace('/[^0-9]/', '', $telefonoComercio);

        // Validación básica: teléfono de comercio debe tener 11 dígitos
        if (strlen($tel) !== 11) {
            // echo 'problema 2';
            return response()->json(['status' => false, 'message' => 'TelefonoComercio inválido']);
        }

        // Si se configuró el teléfono del comercio en .env, exigir coincidencia
        $expectedTel = preg_replace('/[^0-9]/', '', (string) env('R4_TELEFONO_COMERCIO', ''));
        if ($expectedTel !== '' && $expectedTel !== $tel) {
            // echo 'problema 4';
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
        $this->storeRawBancoPayload((string) $request->getContent(), false);

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

        $refDigits = $this->extractReference((string) $ref);
        $telCom = preg_replace('/[^0-9]/', '', $telefonoComercio);
        $telEmi = preg_replace('/[^0-9]/', '', $telefonoEmisor);
        // Validar teléfono de comercio si está configurado
        $expectedTel = preg_replace('/[^0-9]/', '', (string) env('R4_TELEFONO_COMERCIO', ''));
        if ($expectedTel !== '' && $expectedTel !== $telCom) {
            return response()->json(['abono' => false]);
        }

        $cedulaPagador = preg_replace('/[^0-9]/', '', (string) $idComercio);
        if ($cedulaPagador !== '' && is_numeric($monto)) {
            $preCedula = PreOrder::with('metodoPago')
                ->where('created_at', '>=', now()->subDay())
                ->where(function ($query) {
                    $query->whereNull('estatus_preorden')
                        ->orWhere('estatus_preorden', 'pendiente_por_orden');
                })
                ->where('cedula', $cedulaPagador)
                ->where('monto', round((float) $monto, 2))
                ->latest('id')
                ->first();

            if ($preCedula) {
                $this->handleCedulaBasedNotification($preCedula, [
                    'codigoRed' => $codigoRed,
                    'ref_digits' => $refDigits,
                    'telefonoEmisor' => $telEmi,
                    'telefonoComercio' => $telCom,
                    'banco' => $banco,
                    'monto' => $monto,
                    'fechaHora' => $fechaHora,
                    'concepto' => $concepto,
                    'idComercio' => $idComercio,
                    'cedulaPagador' => $cedulaPagador,
                ], $codigos);

                return response()->json(['abono' => true]);
            }
        }

        Log::warning('R4notifica sin pre_orden u orden', ['Banco' => $banco, 'Referencia' => $refDigits, 'Monto' => $monto]);
        return response()->json(['abono' => false]);
    }

    private function storeRawBancoPayload(string $rawBody, bool $isConsulta): void
    {
        try {
            $payload = [
                'request' => $rawBody,
                'reintentos' => 0,
            ];

            if ($isConsulta) {
                NotificacionBancoConsulta::create($payload);
            } else {
                NotificacionBanco::create($payload);
            }
        } catch (\Throwable $exception) {
            Log::error('Error guardando notificación del banco', [
                'tipo' => $isConsulta ? 'consulta' : 'notifica',
                'error' => $exception->getMessage(),
            ]);
        }
    }

    private function preOrderRequiresCedula(PreOrder $pre): bool
    {
        if (!$pre->metodo_pago_id) {
            return false;
        }

        $metodo = $pre->relationLoaded('metodoPago') ? $pre->metodoPago : MetodoPago::find($pre->metodo_pago_id);
        if (!$metodo) {
            return false;
        }

        return stripos((string) $metodo->descripcion, '{{CEDULA_PAGADOR}}') !== false;
    }

    private function handleCedulaBasedNotification(PreOrder $pre, array $data, array $codigos): void
    {
        $codigoRed = (string) ($data['codigoRed'] ?? '');
        $refDigits = (string) ($data['ref_digits'] ?? '');
        $telefonoEmisor = preg_replace('/[^0-9]/', '', (string) ($data['telefonoEmisor'] ?? ''));
        $telefonoComercio = preg_replace('/[^0-9]/', '', (string) ($data['telefonoComercio'] ?? ''));
        $banco = (string) ($data['banco'] ?? '');
        $concepto = (string) ($data['concepto'] ?? '');
        $idComercio = (string) ($data['idComercio'] ?? '');
        $fechaHora = (string) ($data['fechaHora'] ?? now()->toISOString());
        $monto = $data['monto'] ?? null;
        $cedulaPagador = preg_replace('/[^0-9]/', '', (string) ($data['cedulaPagador'] ?? ''));

        $pre->codigo_red = $codigoRed ?: $pre->codigo_red;
        $pre->codigo_red_texto = $codigos[$codigoRed] ?? $pre->codigo_red_texto;
        if ($refDigits !== '') {
            $pre->ref_banco = $refDigits;
        }
        if ($idComercio !== '') {
            $pre->id_comercio = $idComercio;
        }
        if ($telefonoComercio !== '') {
            $pre->telefono_comercio = $telefonoComercio;
        }
        if ($telefonoEmisor !== '') {
            $pre->telefono_emisor = $telefonoEmisor;
        }
        if ($concepto !== '') {
            $pre->concepto = $concepto;
        }
        if ($banco !== '') {
            $pre->banco_emisor = substr($banco, 0, 3) ?: $pre->banco_emisor;
            $bankCode = substr(preg_replace('/[^0-9]/', '', $banco), 0, 4);
            if ($bankCode !== '') {
                $pre->bank_code = $bankCode;
            }
        }
        if (is_numeric($monto)) {
            $pre->monto_notificado = round((float) $monto, 2);
        }
        $pre->fecha_hora = (strtotime($fechaHora) ? date('Y-m-d H:i:s', strtotime($fechaHora)) : now());

        $order = \App\Models\Order::where('pre_order_id', $pre->id)
            ->where('estatus', '<>', '1')
            ->latest('id')
            ->first();

        if ($order) {
            if ($refDigits !== '') {
                $order->ref_banco = $refDigits;
            }
            if ($banco !== '') {
                $bankCode = substr(preg_replace('/[^0-9]/', '', $banco), 0, 4);
                if ($bankCode !== '') {
                    $order->bank_code = $bankCode;
                }
            }
            if ($cedulaPagador !== '') {
                $order->emisor_cedula = $cedulaPagador;
            }
            if ($telefonoEmisor !== '') {
                $order->emisor_telefono = $telefonoEmisor;
            }
            $order->save();
        }

        if ($codigoRed === '00') {
            if ($order) {
                $pre->estatus_preorden = 'aprobada';
                $pre->notificado = true;
                $pre->notificado_at = now();
                $pre->save();

                try {
                    \App\Jobs\ApproveOrderJob::dispatch($order->id)->delay(now()->addSeconds(5));
                } catch (\Throwable $e) {
                    // best effort
                }

                try {
                    (new \App\Jobs\ApproveOrderJob($order->id))->handle();
                } catch (\Throwable $e) {
                    Log::warning('ApproveOrderJob inline fallback falló', [
                        'order_id' => $order->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            } else {
                $pre->estatus_preorden = 'pendiente_por_orden';
                $pre->save();
            }
        } else {
            if (empty($pre->estatus_preorden)) {
                $pre->estatus_preorden = 'pendiente_por_orden';
            }
            $pre->save();
        }
    }

    private function extractReference(string $value, int $length = 6): string
    {
        $digits = preg_replace('/[^0-9]/', '', $value);
        if ($digits === '') {
            return '';
        }

        return substr($digits, -$length);
    }
}
