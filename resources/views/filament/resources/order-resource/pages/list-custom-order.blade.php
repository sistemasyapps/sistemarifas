<x-filament-panels::page>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold tracking-tight">Gestión de Compras</h1>
            <div class="text-sm text-gray-500">
                Total: {{ number_format($totalRecords) }} registros
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-50 p-4 text-green-800 border border-green-200">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 rounded-lg bg-red-50 p-4 text-red-800 border border-red-200">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-funnel class="w-5 h-5 text-primary-500"/>
                    Filtros
                </div>
            </x-slot>

            <div class="grid gap-4 lg:grid-cols-3">
                <div class="lg:col-span-1">
                    <div class="space-y-2">
                        <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                Rifa
                            </span>
                        </label>
                        <select onchange="getParams()" id="rifa_select" class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-2 focus:ring-primary-600 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white dark:bg-white/5 [&:not(:focus)]:shadow-sm rounded-lg border-gray-300 dark:border-white/20">
                            @php
                                $currentRaffleId = $selectedRaffleId ?? optional($allRaffles->first())->id;
                            @endphp
                            @foreach($allRaffles as $raffle)
                                <option value="{{ $raffle->id }}" @selected($raffle->id === $currentRaffleId)>
                                    {{ $raffle->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="space-y-2">
                        <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                Estado
                            </span>
                        </label>
                        <div class="flex flex-wrap gap-2">
                            <x-filament::button 
                                tag="button" 
                                size="sm" 
                                color="{{ ($selectedStatus ?? 0) == 0 ? 'warning' : 'gray' }}" 
                                onclick="filtroEstatus(0)"
                                icon="heroicon-o-clock">
                                Pendientes
                            </x-filament::button>
                            <x-filament::button 
                                tag="button" 
                                size="sm" 
                                color="{{ ($selectedStatus ?? 0) == 1 ? 'success' : 'gray' }}" 
                                onclick="filtroEstatus(1)"
                                icon="heroicon-o-check-circle">
                                Aprobadas
                            </x-filament::button>
                            <x-filament::button 
                                tag="button" 
                                size="sm" 
                                color="{{ ($selectedStatus ?? 0) == 2 ? 'danger' : 'gray' }}" 
                                onclick="filtroEstatus(2)"
                                icon="heroicon-o-x-circle">
                                Canceladas
                            </x-filament::button>
                            <x-filament::button 
                                tag="button" 
                                size="sm" 
                                color="{{ ($selectedStatus ?? 0) == 9 ? 'gray' : 'gray' }}" 
                                onclick="filtroEstatus(9)"
                                icon="heroicon-o-archive-box">
                                Archivadas
                            </x-filament::button>
                        </div>
                    </div>
                </div>
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <x-heroicon-o-list-bullet class="w-5 h-5 text-primary-500"/>
                        Listado de Compras
                    </div>
                    <x-filament::badge color="primary">
                        {{ number_format($totalRecords) }} registros
                    </x-filament::badge>
                </div>
            </x-slot>

            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Mostrar</span>
                    <select id="orders-per-page" class="fi-input w-auto border-none py-1.5 text-base text-gray-950 transition duration-75 focus:ring-2 focus:ring-primary-600 dark:text-white sm:text-sm sm:leading-6 bg-white dark:bg-white/5 [&:not(:focus)]:shadow-sm rounded-lg border-gray-300 dark:border-white/20">
                        @foreach([10, 25, 50, 100] as $option)
                            <option value="{{ $option }}" @selected($perPage === $option)>{{ $option }}</option>
                        @endforeach
                    </select>
                    <span class="text-sm text-gray-500 dark:text-gray-400">registros</span>
                </div>

                <div class="w-full sm:w-64">
                    <x-filament::input.wrapper>
                        <x-slot name="label">
                            Buscar
                        </x-slot>
                        <x-slot name="prefix">
                            <x-heroicon-o-magnifying-glass class="h-4 w-4"/>
                        </x-slot>
                        <x-filament::input
                            id="orders-search"
                            type="search"
                            placeholder="Buscar..."
                            value="{{ $search }}"
                        />
                    </x-filament::input.wrapper>
                </div>
            </div>

            <div class="fi-ta-content overflow-x-auto">
                <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 dark:divide-white/5" id="orderTable">
                    <thead class="bg-gray-50 dark:bg-white/5">
                        <tr class="divide-x divide-gray-200 dark:divide-white/5">
                            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                <div class="flex items-center gap-x-1">
                                    <x-heroicon-m-hashtag class="fi-ta-header-cell-icon h-3.5 w-3.5 text-gray-400 dark:text-gray-500"/>
                                    <span class="fi-ta-header-cell-label text-sm font-medium text-gray-950 dark:text-white">ID</span>
                                </div>
                            </th>
                            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                <div class="flex items-center gap-x-1">
                                    <x-heroicon-m-calendar-days class="fi-ta-header-cell-icon h-3.5 w-3.5 text-gray-400 dark:text-gray-500"/>
                                    <span class="fi-ta-header-cell-label text-sm font-medium text-gray-950 dark:text-white">Fecha</span>
                                </div>
                            </th>
                            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                <div class="flex items-center gap-x-1">
                                    <x-heroicon-m-user class="fi-ta-header-cell-icon h-3.5 w-3.5 text-gray-400 dark:text-gray-500"/>
                                    <span class="fi-ta-header-cell-label text-sm font-medium text-gray-950 dark:text-white">Cliente</span>
                                </div>
                            </th>
                            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 text-center">
                                <div class="flex items-center justify-center gap-x-1">
                                    <x-heroicon-m-ticket class="fi-ta-header-cell-icon h-3.5 w-3.5 text-gray-400 dark:text-gray-500"/>
                                    <span class="fi-ta-header-cell-label text-sm font-medium text-gray-950 dark:text-white">Cant.</span>
                                </div>
                            </th>
                            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                <div class="flex items-center gap-x-1">
                                    <x-heroicon-m-document-text class="fi-ta-header-cell-icon h-3.5 w-3.5 text-gray-400 dark:text-gray-500"/>
                                    <span class="fi-ta-header-cell-label text-sm font-medium text-gray-950 dark:text-white">Referencia</span>
                                </div>
                            </th>
                            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                <div class="flex items-center gap-x-1">
                                    <x-heroicon-m-credit-card class="fi-ta-header-cell-icon h-3.5 w-3.5 text-gray-400 dark:text-gray-500"/>
                                    <span class="fi-ta-header-cell-label text-sm font-medium text-gray-950 dark:text-white">Método</span>
                                </div>
                            </th>
                            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 text-center">
                                <div class="flex items-center justify-center gap-x-1">
                                    <x-heroicon-m-photo class="fi-ta-header-cell-icon h-3.5 w-3.5 text-gray-400 dark:text-gray-500"/>
                                    <span class="fi-ta-header-cell-label text-sm font-medium text-gray-950 dark:text-white">Comprobante</span>
                                </div>
                            </th>
                            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 text-center">
                                <div class="flex items-center justify-center gap-x-1">
                                    <x-heroicon-m-cog-6-tooth class="fi-ta-header-cell-icon h-3.5 w-3.5 text-gray-400 dark:text-gray-500"/>
                                    <span class="fi-ta-header-cell-label text-sm font-medium text-gray-950 dark:text-white">Acciones</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-white/5 bg-white dark:bg-gray-900">
                        @foreach($records as $record)
                            <tr class="fi-ta-row transition-colors hover:bg-gray-50 dark:hover:bg-white/5">
                                <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                    <div class="fi-ta-col-wrp px-3 py-4">
                                        <x-filament::badge color="primary" size="sm">
                                            #{{ $record->id }}
                                        </x-filament::badge>
                                    </div>
                                </td>
                                <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                    <div class="fi-ta-col-wrp px-3 py-4">
                                        <div class="flex flex-col">
                                            <div class="fi-ta-text-item-label text-sm font-medium text-gray-950 dark:text-white">
                                                {{ $record->created_at->format('d/m/Y') }}
                                            </div>
                                            <div class="fi-ta-text-item-description text-sm text-gray-500 dark:text-gray-400">
                                                {{ $record->created_at->format('H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                    <div class="fi-ta-col-wrp px-3 py-4">
                                        <div class="flex flex-col max-w-xs">
                                            <div class="fi-ta-text-item-label text-sm font-medium text-gray-950 dark:text-white truncate">
                                                {{ $record->client->nombre_completo }}
                                            </div>
                                            <div class="fi-ta-text-item-description text-sm text-gray-500 dark:text-gray-400 truncate">
                                                CI: {{ $record->client->cedula }}
                                            </div>
                                            <div class="fi-ta-text-item-description text-sm text-gray-500 dark:text-gray-400 truncate">
                                                {{ $record->client->correo }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                    <div class="fi-ta-col-wrp px-3 py-4 text-center">
                                        <x-filament::badge color="info" size="lg">
                                            {{ $record->cantidad }}
                                        </x-filament::badge>
                                    </div>
                                </td>
                                <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                    <div class="fi-ta-col-wrp px-3 py-4">
                                        <div class="flex flex-col gap-2">
                                            <span class="fi-ta-text-item-label text-sm font-mono font-medium text-gray-950 dark:text-white bg-gray-50 dark:bg-white/5 px-2 py-1 rounded border">
                                                {{ $record->ref_banco }}
                                            </span>
                                            @if ($record->ref_repetido > 1)
                                                <x-filament::badge color="warning" size="sm">
                                                    REPETIDO
                                                </x-filament::badge>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                    <div class="fi-ta-col-wrp px-3 py-4">
                                        @if($record->metodoPago)
                                            <x-filament::badge color="success" size="sm">
                                                {{ strip_tags($record->metodoPago->metodo) }}
                                            </x-filament::badge>
                                        @else
                                            <x-filament::badge color="gray" size="sm">
                                                Sin registrar
                                            </x-filament::badge>
                                        @endif
                                    </div>
                                </td>
                                <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                    <div class="fi-ta-col-wrp px-3 py-4 text-center">
                                        @if($record->ref_imagen)
                                            <button type="button" onclick="openImageModal('{{ Storage::url($record->ref_imagen) }}', '{{ $record->id }}')" class="group relative focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 rounded-lg">
                                                <img src="{{ Storage::url($record->ref_imagen) }}" alt="Comprobante" 
                                                     class="h-16 w-16 rounded-lg object-cover border border-gray-200 dark:border-gray-700 transition-transform group-hover:scale-105">
                                                <div class="absolute inset-0 flex items-center justify-center bg-black/0 group-hover:bg-black/40 rounded-lg transition-all">
                                                    <x-heroicon-o-magnifying-glass-plus class="h-5 w-5 text-white opacity-0 group-hover:opacity-100 transition-opacity"/>
                                                </div>
                                            </button>
                                        @else
                                            <div class="h-16 w-16 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center border border-gray-200 dark:border-gray-700">
                                                <x-heroicon-o-photo class="h-6 w-6 text-gray-400"/>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                    <div class="fi-ta-col-wrp px-3 py-4">
                                        <div class="flex flex-col gap-2 min-w-max">
                                            @if($record->estatus == '0' || $record->estatus == '9')
                                                <x-filament::button 
                                                    id="button-order-{{ $record->id }}" 
                                                    type="button" 
                                                    color="success" 
                                                    size="sm" 
                                                    icon="heroicon-o-check-circle"
                                                    onclick="approveOrder(this, {{ $record->id }})">
                                                    Aprobar
                                                </x-filament::button>
                                                <x-filament::button 
                                                    type="button" 
                                                    color="danger" 
                                                    size="sm" 
                                                    icon="heroicon-o-x-circle"
                                                    onclick="cancelOrder(this, {{ $record->id }})">
                                                    Cancelar
                                                </x-filament::button>
                                            @endif
                                            @if($record->estatus == '1')
                                                <x-filament::button 
                                                    tag="a" 
                                                    href="/ticket/{{ $record->uuid }}" 
                                                    target="_blank" 
                                                    color="primary" 
                                                    size="sm" 
                                                    icon="heroicon-o-ticket">
                                                    Ver Tickets
                                                </x-filament::button>
                                                <x-filament::button 
                                                    type="button" 
                                                    color="danger" 
                                                    size="sm" 
                                                    icon="heroicon-o-trash"
                                                    onclick="deleteOrder(this, {{ $record->id }})">
                                                    Eliminar
                                                </x-filament::button>
                                            @endif
                                            <x-filament::button 
                                                type="button" 
                                                color="warning" 
                                                size="sm" 
                                                icon="heroicon-o-archive-box"
                                                onclick="returnOrder(this, {{ $record->id }})">
                                                Archivar
                                            </x-filament::button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($records->hasPages())
                <div class="mt-6">
                    {{ $records->onEachSide(1)->links() }}
                </div>
            @endif
        </x-filament::section>
    </div>

    <!-- Modal para ver imagen ampliada -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-900/75">
        <div class="relative max-h-screen max-w-screen-lg p-4">
            <x-filament::button 
                type="button" 
                onclick="closeImageModal()" 
                class="absolute top-2 right-2" 
                color="gray" 
                size="sm" 
                icon="heroicon-o-x-mark">
            </x-filament::button>
            <img id="modalImage" src="" alt="Comprobante ampliado" class="max-h-full max-w-full rounded-lg border border-gray-200 dark:border-gray-700">
            <div id="modalInfo" class="absolute bottom-2 left-2 rounded-lg bg-gray-900/90 px-3 py-2 text-white text-sm"></div>
        </div>
    </div>
</x-filament-panels::page>

@push('styles')
    <style>
        /* Image modal */
        #imageModal {
            backdrop-filter: blur(8px);
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    @vite(['resources/js/app.js'])
    <script>
        const baseOrdersUrl = "{{ url('/admin/orders') }}";

        function navigateWithParams(callback) {
            const params = new URLSearchParams(window.location.search);
            callback(params);

            const queryString = params.toString();
            window.location.href = queryString ? `${baseOrdersUrl}?${queryString}` : baseOrdersUrl;
        }

        const perPageSelect = document.getElementById('orders-per-page');
        const searchInput = document.getElementById('orders-search');

        if (perPageSelect) {
            perPageSelect.addEventListener('change', () => {
                const selected = perPageSelect.value;

                navigateWithParams(params => {
                    if (selected) {
                        params.set('per_page', selected);
                    }
                    params.delete('page');
                });
            });
        }

        if (searchInput) {
            let searchTimeout;

            searchInput.addEventListener('input', () => {
                clearTimeout(searchTimeout);

                searchTimeout = setTimeout(() => {
                    const value = searchInput.value.trim();

                    navigateWithParams(params => {
                        if (value) {
                            params.set('search', value);
                        } else {
                            params.delete('search');
                        }
                        params.delete('page');
                    });
                }, 400);
            });

            searchInput.addEventListener('keydown', event => {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    clearTimeout(searchTimeout);

                    const value = searchInput.value.trim();
                    navigateWithParams(params => {
                        if (value) {
                            params.set('search', value);
                        } else {
                            params.delete('search');
                        }
                        params.delete('page');
                    });
                }
            });
        }

        function approveOrder(_this, orderId) {
            const button = document.getElementById(`button-order-${orderId}`);
            if (button) {
                button.disabled = true;
                button.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Procesando...';
            }
            
            axios.post('/api/orderAdmin/' + orderId + '/approve')
                .then(response => {
                    if (response.data.success) {
                        showNotification('Orden aprobada exitosamente', 'success');
                        jQuery(_this).closest('tr').fadeOut(400, function() {
                            $(this).remove();
                        });
                    } else {
                        showNotification('Error al aprobar la orden', 'error');
                        if (button) {
                            button.disabled = false;
                            button.innerHTML = '<svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Aprobar';
                        }
                    }
                })
                .catch(() => {
                    showNotification('Error al aprobar la orden', 'error');
                    if (button) {
                        button.disabled = false;
                        button.innerHTML = '<svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Aprobar';
                    }
                });
        }

        function cancelOrder(_this, orderId) {
            if (! confirm('¿Está seguro de que desea cancelar esta orden?')) {
                return;
            }

            const button = _this;
            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Cancelando...';

            axios.post('/api/orderAdmin/' + orderId + '/cancel')
                .then(response => {
                    if (response.data.success) {
                        showNotification('Orden cancelada exitosamente', 'success');
                        jQuery(_this).closest('tr').fadeOut(400, function() {
                            $(this).remove();
                        });
                    } else {
                        showNotification('Error al cancelar la orden', 'error');
                        button.disabled = false;
                        button.innerHTML = originalText;
                    }
                })
                .catch(() => {
                    showNotification('Error al cancelar la orden', 'error');
                    button.disabled = false;
                    button.innerHTML = originalText;
                });
        }

        function returnOrder(_this, orderId) {
            if (! confirm('¿Está seguro de que desea archivar esta orden?')) {
                return;
            }

            const button = _this;
            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Archivando...';

            axios.post('/api/orderAdmin/' + orderId + '/returnOrder')
                .then(response => {
                    if (response.data.success) {
                        showNotification('Orden archivada exitosamente', 'success');
                        jQuery(_this).closest('tr').fadeOut(400, function() {
                            $(this).remove();
                        });
                    } else {
                        showNotification('Error al archivar la orden', 'error');
                        button.disabled = false;
                        button.innerHTML = originalText;
                    }
                })
                .catch(() => {
                    showNotification('Error al archivar la orden', 'error');
                    button.disabled = false;
                    button.innerHTML = originalText;
                });
        }

        function deleteOrder(_this, orderId) {
            if (! confirm('¿Desea eliminar esta orden? Se eliminarán los números asignados.')) {
                return;
            }

            const clave = prompt('Ingrese la clave para eliminar:');
            if (clave !== 'eliminarAdmin$1$.') {
                showNotification('Clave incorrecta', 'error');
                return;
            }

            const button = _this;
            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Eliminando...';

            axios.post('/api/orderAdmin/' + orderId + '/delete')
                .then(response => {
                    if (response.data.success) {
                        showNotification('Orden eliminada exitosamente', 'success');
                        jQuery(_this).closest('tr').fadeOut(400, function() {
                            $(this).remove();
                        });
                    } else {
                        showNotification('Error al eliminar la orden', 'error');
                        button.disabled = false;
                        button.innerHTML = originalText;
                    }
                })
                .catch(() => {
                    showNotification('Error al eliminar la orden', 'error');
                    button.disabled = false;
                    button.innerHTML = originalText;
                });
        }
        function getParams() {
            const raffleSelect = document.getElementById('rifa_select');

            navigateWithParams(params => {
                if (raffleSelect && raffleSelect.value) {
                    params.set('rifa_select', raffleSelect.value);
                } else {
                    params.delete('rifa_select');
                }

                params.delete('page');
            });
        }

        function filtroEstatus(estatus) {
            navigateWithParams(params => {
                params.set('estatus', estatus);
                params.delete('page');
            });
        }

        // Funciones del modal de imagen
        function openImageModal(imageUrl, orderId) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalInfo = document.getElementById('modalInfo');
            
            modalImage.src = imageUrl;
            modalInfo.textContent = `Orden #${orderId}`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Cerrar con ESC
            document.addEventListener('keydown', closeOnEscape);
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.removeEventListener('keydown', closeOnEscape);
        }

        function closeOnEscape(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        }

        // Sistema de notificaciones mejorado
        function showNotification(message, type = 'info') {
            const colors = {
                success: 'bg-green-500 border-green-600',
                error: 'bg-red-500 border-red-600',
                warning: 'bg-yellow-500 border-yellow-600',
                info: 'bg-blue-500 border-blue-600'
            };

            const icons = {
                success: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>',
                error: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>',
                warning: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>',
                info: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
            };

            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-4 rounded-lg shadow-lg border-l-4 flex items-center gap-3 transform translate-x-full transition-transform duration-300 z-50`;
            notification.innerHTML = `
                ${icons[type]}
                <span class="font-medium">${message}</span>
                <button onclick="this.parentElement.remove()" class="ml-2 hover:bg-white hover:bg-opacity-20 rounded p-1 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;

            document.body.appendChild(notification);

            // Animación de entrada
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            // Auto-remove después de 5 segundos
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 300);
            }, 5000);
        }

        // Cerrar modal al hacer clic fuera de la imagen
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });
    </script>
@endpush
