@extends("layout.app")

@section("content")
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Cantidad</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($topten as $i => $top)
            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$top->nombre}}</td>
                <td>{{$top->cant}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection