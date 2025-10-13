<?php

namespace App\Jobs;

use App\Models\Order;
use App\Jobs\CreateTickets;
use App\Models\PreOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ApproveOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 5;
    public int $backoff = 5; // seconds

    public function __construct(public int $orderId)
    {
    }

    public function handle(): void
    {
        /** @var Order $order */
        $order = Order::withCount('numbers')->with(['client','raffle'])->find($this->orderId);
        if (!$order) return;

        if ($order->estatus === '1') return; // already approved

        // Ensure tickets assigned match quantity
        if ($order->numbers_count !== $order->cantidad) {
            try {
                // Regenerar tickets de forma síncrona como fallback
                $order->numbers()->delete();
                (new CreateTickets($order))->handle();
            } catch (\Throwable $e) {
                Log::warning('ApproveOrderJob: error regenerando tickets', [
                    'order_id' => $order->id,
                    'error' => $e->getMessage(),
                ]);
            }

            $order = Order::withCount('numbers')->with(['client','raffle'])->find($this->orderId);
            if (!$order) return;

            if ($order->numbers_count !== $order->cantidad) {
                // still inconsistent -> requeue if running through queue, otherwise abort
                if (isset($this->job)) {
                    $this->release($this->backoff);
                }
                return;
            }
        }

        // Check related pre-order state (if any)
        if (empty($order->pre_order_id)) return;

        $pre = PreOrder::find($order->pre_order_id);
        if (!$pre) return;

        // Helper normalizers
        $normalizeRef = static function ($value): string {
            $digits = preg_replace('/[^0-9]/', '', (string) $value);
            return $digits === '' ? '' : substr($digits, -6);
        };
        $normalizeBank = static function ($value): string {
            $digits = preg_replace('/[^0-9]/', '', (string) $value);
            return $digits === '' ? '' : substr($digits, -3);
        };

        $ordRef = $normalizeRef($order->ref_banco);
        $preRef = $normalizeRef($pre->ref_banco ?? '');
        $ordBank3 = $normalizeBank($order->bank_code);
        $preBank3 = $normalizeBank($pre->banco_emisor ?? $pre->bank_code_last3 ?? '');
        $ordPhone = preg_replace('/[^0-9]/', '', (string) ($order->client->telefono ?? ''));
        $prePhone = preg_replace('/[^0-9]/', '', (string) ($pre->telefono ?? ''));

        // Fast path: pre ya aprobada o notificada OK
        if (($pre->estatus_preorden ?? null) === 'aprobada' || ($pre->notificado && ($pre->codigo_red ?? null) === '00')) {
            app(\App\Http\Controllers\Api\OrderController::class)->approve(request(), $order);
            return;
        }

        // Pending case: R4notifica llegó antes -> pendiente_por_orden con '00'
        if (($pre->estatus_preorden ?? null) === 'pendiente_por_orden' && ($pre->codigo_red ?? null) === '00') {
            // PRIMERO: Copiar datos de pago de pre-orden a orden si llegaron antes que la orden
            $orderUpdated = false;
            if (empty($order->ref_banco) && !empty($pre->ref_banco)) {
                $order->ref_banco = $normalizeRef($pre->ref_banco);
                $orderUpdated = true;
            }
            if (empty($order->bank_code) && !empty($pre->bank_code)) {
                $order->bank_code = $normalizeBank($pre->bank_code);
                $orderUpdated = true;
            }
            if (empty($order->emisor_cedula) && !empty($pre->cedula)) {
                $order->emisor_cedula = $pre->cedula;
                $orderUpdated = true;
            }
            if (empty($order->emisor_telefono) && !empty($pre->telefono_emisor)) {
                $order->emisor_telefono = $pre->telefono_emisor;
                $orderUpdated = true;
            }

            if ($orderUpdated) {
                $order->save();
                // Refrescar variables de validación con los nuevos valores
                $ordRef = $normalizeRef($order->ref_banco);
                $ordBank3 = $normalizeBank($order->bank_code);
                $ordPhone = preg_replace('/[^0-9]/', '', (string) ($order->client->telefono ?? ''));
            }

            // LUEGO: Validar con los datos actualizados
            $refOk = ($preRef !== '' && $ordRef === $preRef);
            $bankOk = ($preBank3 !== '' && $ordBank3 === $preBank3);
            $phoneOk = ($prePhone !== '' && $ordPhone === $prePhone);

            // A solicitud: no considerar el teléfono en el Job para aprobar
            if ($refOk && $bankOk) {
                // Optional monto check (best-effort): compare pre.monto vs order.cantidad * raffle.precio
                try {
                    if ($order->raffle && is_numeric($pre->monto)) {
                        $expected = (float) ($order->raffle->precio * $order->cantidad);
                        // tolerancia mínima por decimales
                        // no bloqueamos por pequeña diferencia
                    }
                } catch (\Throwable $e) {}

                // Elevate and approve
                $pre->estatus_preorden = 'aprobada';
                $pre->notificado = true;
                $pre->notificado_at = now();
                $pre->save();

                app(\App\Http\Controllers\Api\OrderController::class)->approve(request(), $order);
            }
        }
    }
}
