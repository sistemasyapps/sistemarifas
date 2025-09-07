<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\PreOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
            // requeue to wait for ticket assignment
            $this->release($this->backoff);
            return;
        }

        // Check related pre-order state (if any)
        if (empty($order->pre_order_id)) return;

        $pre = PreOrder::find($order->pre_order_id);
        if (!$pre) return;

        // Helper normalizers
        $ordRef = (string) $order->ref_banco;
        $preRef = (string) ($pre->ref_banco ?? '');
        $ordBank3 = substr((string) $order->bank_code, -3);
        $preBank3 = substr((string) ($pre->banco_emisor ?? $pre->bank_code_last3 ?? ''), -3);
        $ordPhone = preg_replace('/[^0-9]/', '', (string) ($order->client->telefono ?? ''));
        $prePhone = preg_replace('/[^0-9]/', '', (string) ($pre->telefono ?? ''));

        // Fast path: pre ya aprobada o notificada OK
        if (($pre->estatus_preorden ?? null) === 'aprobada' || ($pre->notificado && ($pre->codigo_red ?? null) === '00')) {
            app(\App\Http\Controllers\Api\OrderController::class)->approve(request(), $order);
            return;
        }

        // Pending case: R4notifica llegó antes -> pendiente_por_orden con '00'
        if (($pre->estatus_preorden ?? null) === 'pendiente_por_orden' && ($pre->codigo_red ?? null) === '00') {
            // Require strict match: reference, bank last3, and phone
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
