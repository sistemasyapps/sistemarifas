<x-filament-widgets::widget>
    <x-filament::section>
        <div style="height: 300px; overflow: auto;">
            <h3 class="text-lg font-bold mb-4">Ordenes por País</h3>
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Pais</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($data as $row)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $row->pais }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $row->ordenes }}</td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
