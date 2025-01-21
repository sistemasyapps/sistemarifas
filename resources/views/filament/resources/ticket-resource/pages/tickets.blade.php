<x-filament-panels::page>
    <div class="filament-page">
        <div class="filament-page-body bg-white shadow overflow-hidden sm:rounded-lg p-3">
            <form methdod="get">
                <div class="mt-10 grid grid-cols-2 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="nro_buscar" class="block text-sm font-medium leading-6 text-gray-900">Rifa</label>
                        <select required id="rifa" name="rifa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">SELECCIONE UNA RIFA</option>
                            @foreach ($raffles as $raffle)
                                <option value="{{$raffle->id}}">{{$raffle->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="nro_buscar" class="block text-sm font-medium leading-6 text-gray-900">Numeros a buscar</label>
                        <div class="mt-2">
                            <input required type="text" name="nro_buscar" id="nro_buscar" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                    </div>
                    <div>
                        <table class="w-full divide-y divide-gray-200 dark:bg-gray-600" id="orderTable">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase ">Cliente</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase ">Número</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase ">Fecha</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($searched as $search)
                                    <tr>
                                        <td class="px-6 py-4 ">{{$search->nombre_completo}} {{$search->correo}} 
                                            <a href="https://wa.me/58{{$search->telefono}}" target="_blank" >{{$search->telefono}}</a>
                                            
                                        </td>
                                        <td class="px-6 py-4 ">{{ str_pad($search->numero_generado,4,0,STR_PAD_LEFT) }}</td>
                                        <td class="px-6 py-4 ">{{$search->created_at}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit" class="rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">Buscar</button>
                </div>
            </form>
        </div>
    </div>
</x-filament-panels::page>
