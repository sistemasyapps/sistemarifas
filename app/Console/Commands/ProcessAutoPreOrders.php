<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\OrderController;
use App\Models\MetodoPago;
use App\Models\PreOrder;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ProcessAutoPreOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'preorders:process-auto {--limit=50 : Cantidad máxima de preórdenes a procesar por ejecución}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea órdenes para preórdenes aprobadas automáticamente (R4) que aún no tienen orden vinculada.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $limit = (int) $this->option('limit');
        if ($limit <= 0) {
            $limit = 50;
        }

        $preOrders = PreOrder::query()
            ->whereNull('consumida_at')
            ->whereDoesntHave('order')
            ->whereNotNull('codigo_red')
            ->where('codigo_red', '00')
            ->where('created_at', '>=', now()->subDay())
            ->whereExists(function ($query) {
                $query->selectRaw(1)
                    ->from('raffles')
                    ->whereColumn('raffles.id', 'pre_orders.raffle_id')
                    ->where('raffles.estatus_compra', 1)
                    ->where('raffles.estatus', 1);
            })
            ->where(function ($query) {
                $query->where('estatus_preorden', 'aprobada')
                    ->orWhere('estatus_preorden', 'pendiente_por_orden')
                    ->orWhereNull('estatus_preorden');
            })
            ->orderByDesc('id')
            ->limit($limit)
            ->get();

        if ($preOrders->isEmpty()) {
            $this->info('No hay preórdenes automáticas pendientes por procesar.');
            return self::SUCCESS;
        }

        $orderController = app(OrderController::class);
        $processed = 0;
        $skipped = 0;

        foreach ($preOrders as $preOrder) {
            if (! $this->canProcess($preOrder)) {
                $skipped++;
                continue;
            }

            $payload = $this->buildPayload($preOrder);
            if ($payload === null) {
                Log::warning('PreOrder automática omitida: datos incompletos', [
                    'pre_order_id' => $preOrder->id,
                    'uuid' => $preOrder->uuid,
                ]);
                $skipped++;
                continue;
            }

            $request = Request::create('/api/orderCliente', 'POST', $payload);
            $request->setUserResolver(fn () => null);
            $request->attributes->set('ipquery', [
                'location' => [
                    'country' => 'Venezuela',
                    'state' => 'Automática',
                    'city' => 'Automática',
                ],
            ]);
            $request->server->set('REMOTE_ADDR', $preOrder->IP ?? '127.0.0.1');

            try {
                $response = $orderController->create($request);
            } catch (\Throwable $e) {
                Log::error('Error creando orden desde preorden automática', [
                    'pre_order_id' => $preOrder->id,
                    'uuid' => $preOrder->uuid,
                    'error' => $e->getMessage(),
                ]);
                $skipped++;
                continue;
            }

            if ($response->getStatusCode() === Response::HTTP_CREATED) {
                $processed++;
                $this->info(sprintf(
                    'Orden creada para preorden #%d (%s)',
                    $preOrder->id,
                    $preOrder->uuid
                ));
            } else {
                $payloadBody = $response->getData(true);
                Log::warning('Respuesta inesperada al crear orden automática', [
                    'pre_order_id' => $preOrder->id,
                    'uuid' => $preOrder->uuid,
                    'status' => $response->getStatusCode(),
                    'body' => $payloadBody,
                ]);
                $skipped++;
            }
        }

        $this->info(sprintf(
            'Preórdenes procesadas: %d, omitidas: %d',
            $processed,
            $skipped
        ));

        return self::SUCCESS;
    }

    private function canProcess(PreOrder $preOrder): bool
    {
        if ($preOrder->order()->exists()) {
            return false;
        }

        if (! $preOrder->metodo_pago_id) {
            return false;
        }

        $metodo = MetodoPago::find($preOrder->metodo_pago_id);
        if (! $metodo) {
            return false;
        }

        $requiresCedulaPagador = stripos((string) $metodo->descripcion, '{{CEDULA_PAGADOR}}') !== false;

        if ($requiresCedulaPagador && empty($preOrder->cedula)) {
            return false;
        }

        if ((empty($preOrder->cliente_cedula) && empty($preOrder->cedula)) || empty($preOrder->nombre_completo) || empty($preOrder->correo)) {
            return false;
        }

        return true;
    }

    private function buildPayload(PreOrder $preOrder): ?array
    {
        $telefono = preg_replace('/[^0-9]/', '', (string) $preOrder->telefono);
        if ($telefono === '' || strlen($telefono) < 10) {
            return null;
        }

        $payload = [
            'raffle_id' => $preOrder->raffle_id,
            'cedula' => $preOrder->cliente_cedula ?? $preOrder->cedula ?? '',
            'nombre_completo' => $preOrder->nombre_completo ?? '',
            'correo' => trim((string) $preOrder->correo),
            'tlf' => $telefono,
            'cantidad' => $preOrder->cantidad,
            'metodo_pago_id' => $preOrder->metodo_pago_id,
            'pre_order_uuid' => $preOrder->uuid,
        ];

        $emisorCedula = $preOrder->emisor_cedula ?? $preOrder->cedula;
        if (! empty($emisorCedula)) {
            $payload['emisor_cedula'] = preg_replace('/[^0-9]/', '', (string) $emisorCedula);
        }
        if (! empty($preOrder->telefono_emisor)) {
            $payload['emisor_telefono'] = preg_replace('/[^0-9]/', '', (string) $preOrder->telefono_emisor);
        }
        if (! empty($preOrder->ref_banco)) {
            $cleanRef = preg_replace('/[^0-9]/', '', (string) $preOrder->ref_banco);
            if ($cleanRef !== '') {
                $payload['ref_banco'] = substr($cleanRef, -6);
            }
        }
        if (! empty($preOrder->bank_code)) {
            $cleanCode = preg_replace('/[^0-9]/', '', (string) $preOrder->bank_code);
            if ($cleanCode !== '') {
                $payload['bank_code'] = substr($cleanCode, -3);
            }
        } elseif (! empty($preOrder->banco_emisor)) {
            $cleanCode = preg_replace('/[^0-9]/', '', (string) $preOrder->banco_emisor);
            if ($cleanCode !== '') {
                $payload['bank_code'] = substr($cleanCode, -3);
            }
        }

        return $payload;
    }
}
