<x-filament-panels::page>


    <div class="filament-page">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="filament-page-body bg-white shadow overflow-hidden sm:rounded-lg relative overflow-x-auto">
            <div style="margin-bottom: 20px">
                <select onchange="getParams()" id="rifa_select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($allRaffles as $j => $ar)
                        <option @if($ar->id == ($_GET['rifa_select'] ?? $allRaffles[0]->id)) selected @endif value="{{$ar->id}}">{{$ar->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button onclick="filtroEstatus(0)" class="boton_filtro" type="button">Pendientes</button>
                <button onclick="filtroEstatus(1)" class="boton_filtro" type="button">Aprobadas</button>
                <button onclick="filtroEstatus(2)" class="boton_filtro" type="button">Canceladas</button>
            </div>
            <table class="w-full text-sm text-left dark:text-gray-400" id="orderTable">
                <thead class="bg-gray-50">
                    <tr>
                        
                        <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase ">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase ">Creado</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase ">Cliente</th>
                        
                        <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase ">Cantidad</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase ">Referencia</th>
                        
                        <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase w-1">Imagen de Referencia</th>
                        
                        
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($records as $record)
                        <tr>
                            <td class="px-6 py-4 ">{{ $record->id }}</td>
                            <td class="px-6 py-4 ">{{ $record->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-6 py-4 ">{{$record->client->cedula}} - {{ $record->client->nombre_completo }} - {{ $record->client->correo }} - {{ $record->client->telefono }}</td>
                            <td class="px-6 py-4 ">{{ $record->cantidad }}</td>
                            <td class="px-6 py-4 ">{{ $record->ref_banco }}</td>
                            
                            <td class="px-6 py-4">
                                <a href="{{ Storage::url($record->ref_imagen) }}" data-lightbox="ref-imagen-{{ $record->id }}">
                                    <img src="{{ Storage::url($record->ref_imagen) }}" alt="Referencia bancaria" class="w-12 h-12 object-cover">
                                </a>
                            </td>
                            <td class="px-6 py-4 ">
                                @if($record->estatus == '0')
                                    <button type="button" onclick="approveOrder({{ $record->id }})" id="button-order-{{ $record->id }}" class="font-bold py-2 px-4 rounded">Aprobar</button>
                                    <button type="button" onclick="cancelOrder({{ $record->id }})" class="py-2 px-4 rounded">Cancelar</button>
                                @endif
                                @if($record->estatus == '1')
                                    <a href="/ticket/{{$record->uuid}}" target="_blank">Ver Tickets</a>
                                    <button type="button" onclick="deleteOrder({{ $record->id }})" class="font-bold py-2 px-4 rounded">Eliminar</button>
                                @endif
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-filament-panels::page>

@push('styles')
    <link href="{{ asset('node_modules/lightbox2/dist/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="//cdn.datatables.net/2.1.0/css/dataTables.dataTables.min.css" rel="stylesheet">
    
    <style>
        .boton_filtro {
            background-color:#6F04AC;
            border-radius:10px;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-size:14px;
            font-weight:bold;
            padding:10px 20px;
            text-decoration:none;
        }
        .filtro_activo {
            background-color: #2F0861!important;
        }
    </style>
@endpush

@push('scripts')
	<script src="{{ asset('/node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('node_modules/lightbox2/dist/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('build/assets/app-33584bf2.js') }}"></script>
    <script src="//cdn.datatables.net/2.1.0/js/dataTables.min.js"></script>
    
    <script>

        let table = new DataTable('#orderTable');

        function approveOrder(orderId) {
            const button = document.getElementById(`button-order-${orderId}`);
            button.disabled = true;
            axios.post('/api/orderAdmin/' + orderId + '/approve')
            .then(response => {
                if (response.data.success) {
                    // alert('Order aprobada');
                    location.reload();
                } else {
                    alert('Error al aprobar la orden.');
                }
            })
            .catch(error => {
                alert('Error al aprobar la orden.');
            });
        }
        function cancelOrder(orderId) {
            if(confirm("Desea cancelar esta orden?"))
            {
                axios.post('/api/orderAdmin/' + orderId + '/cancel')
                .then(response => {
                    if (response.data.success) {
                        alert('Order cancelada exitosamente.');
                        location.reload();
                    } else {
                        alert('Error al cancelar la orden.');
                    }
                })
                .catch(error => {
                    alert('Error al cancelar la orden.');
                });
            }
        }

        function deleteOrder(orderId) {
            if(confirm("Desea eliminar esta orden?, se eliminaran los números asignados"))
            {
                const clave = prompt('Ingrese la clave para eliminar');
                if (clave == "eliminarAdmin$1$.") {
                    axios.post('/api/orderAdmin/' + orderId + '/delete')
                    .then(response => {
                        if (response.data.success) {
                            alert('Order eliminada exitosamente.');
                            location.reload();
                        } else {
                            alert('Error al eliminar la orden.');
                        }
                    })
                    .catch(error => {
                        alert('Error al eliminar la orden.');
                    });
                }
            }
        }

        function getParams() {
            const urlParams = new URLSearchParams(window.location.search);
            const rifa_select = document.getElementById("rifa_select").value;
            let URL = '{{ config('app.url') }}/admin/orders?';
            data_send = "rifa_select="+rifa_select;

            if (urlParams.has('estatus')) {
                const estatus = urlParams.get('estatus');

                const params = [estatus, rifa_select];
                data_send = `estatus=${estatus}&rifa_select=${rifa_select}`;
            }

            URL += data_send;
            window.location.href = URL;
        }

        function filtroEstatus(estatus) {
            const urlParams = new URLSearchParams(window.location.search);
            let URL = '{{ config('app.url') }}/admin/orders?';
            data_send = "estatus="+estatus;
            if (urlParams.has('rifa_select')) {
                const rifa_select = urlParams.get('rifa_select');
                const params = [estatus, rifa_select];
                data_send = `estatus=${estatus}&rifa_select=${rifa_select}`;
            }
            // const url = '{{ config('app.url') }}/admin/orders?estatus='+estatus;
            URL += data_send;
            window.location.href = URL;
        }
    </script>
@endpush