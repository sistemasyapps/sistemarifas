<!DOCTYPE html>
<html>
<head>
    <title>Compra Aprobada</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="background: #222; color: white!important">
    <div style="padding-left: 15px; padding-right: 15px">
        <h1 style="color: white!important">Compra Aprobada</h1>
        <p style="color: white!important">Hola, {{ $order->client->nombre_completo }}</p>
        @if($from == "url")
        <p style="color: white!important">Usted esta participando por <h3>{{ $order->raffle->nombre }}</h3></p>
        <img src="{{url('/')}}{{ Storage::url($order->raffle->imagen_banner) }}" alt="{{$order->raffle->imagen_banner}}" style="display: block; margin: 0 auto; width: 300px" />
        @endif
        <p style="color: white!important">Boletos comprados</p>
        <div>
            <ul style="list-style: none; margin: 0; padding: 0">
            @foreach ($numbers as $number)
                <li style="padding: 10px 0px; margin-right: 7px; margin-bottom: 10px; display: inline-block; background: #e0a617; border-radius: 8px; width: 80px; box-shadow: 4px 2px 0px 2px black; text-align: center;">
                    <span style="color: black; padding: 15px; font-weight: bolder; font-size: 21px;">
                        {{ str_pad($number,4,0,STR_PAD_LEFT) }}
                    </span>
                </li>
            @endforeach
            </ul>
        </div>
        <p style="color: white!important">¡Guarda este correo y si eres el afortunado ganador, el día del sorteo te contactaremos para darte la gran noticia!</p>
    </div>

    <div style="background-color: #e0a617 !important">
        <div style="padding-top: .25rem !important; padding-bottom: .25rem !important; justify-content: center !important;display: flex !important; align-content: center; align-items: center; margin: 0 auto;">
            <img src="https://ganaconandreaaular.com/assets/images/logos/logo.png" width="200" style="width: 200px; margin: 0 auto; align-content: center; align-items: center;" />
        </div>
    </div>
</body>
</html>