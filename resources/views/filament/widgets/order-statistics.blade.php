<x-filament-widgets::widget>
    <x-filament::section>
        @foreach($data as $i => $rows)
        @if($rows)
        <div>
            <x-filament::button color="success" href="{{config('app.url')}}/listadoTickets/{{$rows[0]->id}}"
            tag="a" target="_blank">
                Imprimir Listado
            </x-filament::button>
            <x-filament::button color="success" href="{{config('app.url')}}"
            tag="a" target="_blank">
                Link de Compra
            </x-filament::button>
            
        </div>
        @endif
        <div style="height: 300px; overflow: auto; margin-bottom: 10px; margin-top: 10px;">
            <h3 class="text-lg font-bold mb-4">Ordenes por Día {{$rows[0]->nombre ?? ""}}</h3>
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Día</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Ordenes</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($rows as $row)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $row->dia }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $row->ordenes }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $row->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-right text-lg text-gray-500 uppercase" colspan="2">Total</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-lg text-gray-500 uppercase">{{$total[$i]}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <hr style="border: 1px solid black" />
        @endforeach
    </x-filament::section>
</x-filament-widgets::widget>
