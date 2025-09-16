<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Helpers\RaffleHelper;
use App\Models\Order;
use Filament\Resources\Pages\Page;
use Illuminate\Pagination\LengthAwarePaginator;

class ListCustomOrder extends Page
{
    protected static string $resource = OrderResource::class;

    protected static string $view = 'filament.resources.order-resource.pages.list-custom-order';

    protected static ?string $title = 'Gestión de Compras';

    private const PER_PAGE_OPTIONS = [10, 25, 50, 100];

    public $allRaffles = [];
    public $estatus;
    public $raffleId;
    public $perPage;
    public $search;

    protected ?LengthAwarePaginator $recordsCache = null;

    public function mount()
    {
        $this->allRaffles = RaffleHelper::getLastTen();

        $this->estatus = (string) request()->query('estatus', '0');

        $defaultRaffleId = optional($this->allRaffles->first())->id;

        $requestedRaffleId = request()->query('rifa_select');
        $this->raffleId = $requestedRaffleId !== null && $requestedRaffleId !== ''
            ? (int) $requestedRaffleId
            : ($defaultRaffleId !== null ? (int) $defaultRaffleId : null);

        $requestedPerPage = (int) request()->query('per_page', 25);
        $this->perPage = in_array($requestedPerPage, self::PER_PAGE_OPTIONS, true)
            ? $requestedPerPage
            : 25;

        $this->search = trim((string) request()->query('search', ''));
    }

    protected function getViewData(): array
    {
        $records = $this->resolveRecords();

        return [
            'allRaffles' => $this->allRaffles,
            'records' => $records,
            'selectedRaffleId' => $this->raffleId,
            'selectedStatus' => $this->estatus,
            'perPage' => $this->perPage,
            'search' => $this->search,
            'totalRecords' => $records->total(),
            'displayedRecords' => $records->count(),
        ];
    }

    protected function getRecords()
    {
        if (! $this->raffleId) {
            return $this->emptyPaginator();
        }

        $query = Order::query()
            ->with([
                'client:id,cedula,nombre_completo,correo,telefono',
                'raffle:id,nombre',
                'metodoPago:id,metodo',
            ])
            ->select('orders.*')
            ->selectRaw('(
                SELECT COUNT(*)
                FROM orders as o2
                WHERE o2.ref_banco = orders.ref_banco
                    AND o2.raffle_id = orders.raffle_id
            ) as ref_repetido')
            ->where('orders.estatus', $this->estatus)
            ->where('orders.raffle_id', $this->raffleId)
            ->when($this->search !== '', function ($query) {
                $search = $this->search;
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery
                        ->where('orders.ref_banco', 'like', "%{$search}%")
                        ->orWhere('orders.emisor_cedula', 'like', "%{$search}%")
                        ->orWhere('orders.emisor_telefono', 'like', "%{$search}%")
                        ->orWhereHas('client', function ($clientQuery) use ($search) {
                            $clientQuery->where(function ($clientInner) use ($search) {
                                $clientInner
                                    ->where('cedula', 'like', "%{$search}%")
                                    ->orWhere('nombre_completo', 'like', "%{$search}%")
                                    ->orWhere('correo', 'like', "%{$search}%")
                                    ->orWhere('telefono', 'like', "%{$search}%");
                            });
                        })
                        ->orWhereHas('metodoPago', function ($metodoQuery) use ($search) {
                            $metodoQuery->where('metodo', 'like', "%{$search}%");
                        });

                    if (is_numeric($search)) {
                        $innerQuery->orWhere('orders.id', (int) $search);
                    }
                });
            })
            ->orderByDesc('orders.id');

        return $query->paginate(
            $this->perPage,
            ['*'],
            'page',
            $this->getCurrentPage()
        )->withQueryString();
    }

    protected function resolveRecords(): LengthAwarePaginator
    {
        if ($this->recordsCache instanceof LengthAwarePaginator) {
            return $this->recordsCache;
        }

        $this->recordsCache = $this->getRecords();

        return $this->recordsCache;
    }

    protected function emptyPaginator(): LengthAwarePaginator
    {
        return new LengthAwarePaginator(
            [],
            0,
            $this->perPage,
            $this->getCurrentPage(),
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    protected function getCurrentPage(): int
    {
        $page = (int) request()->query('page', 1);

        return $page > 0 ? $page : 1;
    }
}
