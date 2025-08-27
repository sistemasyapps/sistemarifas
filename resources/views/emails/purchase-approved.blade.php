<!DOCTYPE html>
<html lang="es">
<head>
    <title>Compra</title>
    <meta charset="utf-8">
    <meta content='text/html; charset=UTF-8' http-equiv='Content-Type' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="background: #222; color: white!important">
    <div style="padding-left: 15px; padding-right: 15px">
        @if($order->estatus == 1)
        <h1>Compra Aprobada</h1>
        @elseif($order->estatus == 0)
        <h1>Compra Pendiente</h1> para la rifa <p><b>{{ $order->raffle->nombre }}</b></p>
        @else
        <h1>Compra Cancelada</h1>
        @endif

        @if($order->estatus == 1)
            <p style="color: white!important">Hola, {{ $order->client->nombre_completo }}, su compra ha sido aprobada y verificada correctamente.</p>
            @if($from == "url")
            <p style="color: white!important">
                Usted esta participando por 
                <b>{{ $order->raffle->nombre }}</b>
            </p>
            <img src="{{url('/')}}{{ Storage::url($order->raffle->imagen_banner) }}" alt="{{$order->raffle->imagen_banner}}" style="display: block; margin: 0 auto; width: 300px">
            @endif
        @endif
        
        <p style="color: white!important">Boletos comprados</p>
        <div>
            <ul style="list-style: none; margin: 0; padding: 0">
            @foreach ($numbers as $number)
                <li style="padding: 10px 0px; margin-right: 7px; margin-bottom: 10px; display: inline-block; background: #5D2138; border-radius: 8px; width: 100px; box-shadow: 4px 2px 0px 2px black; text-align: center;">
                    <span style="color: white; padding: 15px; font-weight: bolder; font-size: 21px;">
                        {{ str_pad($number->numero_generado,4,0,STR_PAD_LEFT) }}
                    </span>
                </li>
            @endforeach
            </ul>
        </div>
        <div>
            @if($order->estatus == 0)
                <b>Esta compra esta en Estado PENDIENTE, por lo tanto sus tickets no son validos hasta que se valide la compra, una vez reciba un correo y/o un whatsapp con su compra aprobada, estos tickets seran validos</b> 
            @endif
        </div>
        <div style="padding-left: 15px; padding-right: 15px">
            <p>
                Guarda este correo, si eres el afortunado ganador te estaremos llamando muy pronto. además recuerda que mientras mas tickets compres mas oportunidades tienes de ganar.
            </p>
            <p style="color: white!important">
                Mantente alerta y síguenos en nuestras redes para estar atento a nuestras publicaciones @rifasvinotintos
            </p>
            <p>
                Si tienes alguna duda, en nuestro sitio web https://rifasvinotinto.com/ podrás conseguir 2 botones, para devoluciones y soporte técnico, siempre podrás conseguirnos en el número de soporte +58 412-8302095
            </p>
        </div>
    </div>
    <div style="background-color: #5D2138 !important; text-align: center;">
        <div style="text-align: center; padding-top: .25rem !important; padding-bottom: .25rem !important; justify-content: center !important;display: flex !important; align-content: center; align-items: center; margin: 0 auto;">
            <img src="{{ Storage::url($logo)}}" alt="logo rifasvinotinto" width="200" style="width: 200px; margin: 0 auto; align-content: center; align-items: center;">
        </div>
        <p style="margin: 0; font-size: 0.9em; color: #5D2138;">
                © 2025 RifasVinotinto.com<br>
                Todos los derechos reservados
            </p>
    </div>
</body>
</html>