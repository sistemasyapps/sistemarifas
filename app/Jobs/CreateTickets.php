<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class CreateTickets implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    /**
     * Create a new job instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->order->estatus != 2){
            try{
                Log::info('Creando numeros en CreateTickets');
                $numbers = $this->generateUniqueNumber($this->order->raffle_id, $this->order->cantidad, $this->order->raffle->cantidad_max);

                foreach ($numbers as $number) {
                    $this->order->numbers()->create([
                        'numero_generado' => $number,
                        'raffle_id'=> $this->order->raffle_id
                    ]);
                }
            } catch(Exception $e) {
                Log::error("Error al crear numeros en la orden ".$e->getMessage());
            }
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
}
