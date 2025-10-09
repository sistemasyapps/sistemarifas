<?php

namespace App\Console\Commands;

use App\Models\PreOrder;
use Illuminate\Console\Command;

class CleanStalePreOrders extends Command
{
    protected $signature = 'preorders:purge {--hours=24 : Cantidad de horas después de las cuales las preórdenes se consideran caducadas} {--dry-run : Mostrar el total sin eliminar registros}';

    protected $description = 'Elimina preórdenes huérfanas que no derivaron en una orden y caducaron.';

    public function handle(): int
    {
        $hours = (int) $this->option('hours');
        if ($hours <= 0) {
            $hours = 24;
        }

        $cutoff = now()->subHours($hours);

        $query = PreOrder::query()
            ->whereNull('consumida_at')
            ->whereNull('estatus_preorden')
            ->where('created_at', '<=', $cutoff)
            ->whereDoesntHave('order');

        $count = (clone $query)->count();

        if ($count === 0) {
            $this->info('No se encontraron preórdenes caducadas.');
            return self::SUCCESS;
        }

        if ($this->option('dry-run')) {
            $this->info(sprintf(
                'Se eliminarían %d preórdenes anteriores a %s.',
                $count,
                $cutoff->toDateTimeString()
            ));

            return self::SUCCESS;
        }

        $deleted = $query->delete();

        $this->info(sprintf(
            'Se eliminaron %d preórdenes anteriores a %s.',
            $deleted,
            $cutoff->toDateTimeString()
        ));

        return self::SUCCESS;
    }
}
