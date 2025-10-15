<x-filament-widgets::widget>
    <x-filament::section class="space-y-8">
        @forelse($raffles as $raffleData)
            <div>
                <h3 class="text-lg font-bold mb-4">TopTen - {{ $raffleData['raffle']->nombre }}</h3>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Tickets</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($raffleData['data'] as $row)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $row->nombre }}</td>
                                <td class="px-6 py-4">{{ $row->tickets }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-4 text-sm text-gray-500 text-center">Sin registros para esta rifa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @empty
            <p class="text-sm text-gray-500">No hay rifas activas.</p>
        @endforelse
    </x-filament::section>
</x-filament-widgets::widget>
