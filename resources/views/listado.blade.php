<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listado de Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Nombre Completo</th>
						<th>Ticket</th>
					</tr>
				</thead>
				<tbody>
					@foreach($numeros as $numero)
						@foreach($numero->numbers as $num)
							<tr>
								<td>{{$numero->client->nombre_completo}}</td>
								<td>{{$num->numero_generado}}</td>
							</tr>
						@endforeach
					@endforeach
				</tbody>
			</table>
    </div>
  </body>
</html>