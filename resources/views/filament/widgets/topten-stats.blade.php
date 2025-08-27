<x-filament-widgets::widget>
    <x-filament::section>
    <div>
            <h3 class="text-lg font-bold mb-4">TopTen</h3>
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Tickets</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($data as $row)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $row->nombre }}</td>
                            <td class="px-6 py-4">{{ $row->tickets }}</td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
