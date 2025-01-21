<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de compra</title>
</head>
<body style="background: #222; color: white!important">
    <div style="padding-left: 15px; padding-right: 15px">
        <h1 style="color: white!important">Confirmación de compra</h1>
        <p style="color: white!important">Hola, {{ $order->client->nombre_completo }}</p>
        <p style="color: white!important">Hemos recibido tu orden, gracias por comprar con Andrea Aular</p>
        <p style="color: white!important">Puedes seguir usando nuestra plataforma para comprar, recuerda que mientras más tickets compres, más oportunidades tienes de ganar. Tus datos y tu pago serán verificados en un lapso de 12 a 24 horas. Una vez que el equipo valide la información, recibirás un correo y un whatsapp con los datos de tu compra aprobada anexado a tus números de participación, los cuales son generados de manera aleatoria automáticamente.</p>
        <p style="color: white!important">Mantente alerta y síguenos en nuestras redes para estar atento a nuestras publicaciones @andreastefaular.21</p>
    </div>

    <div style="background-color: #e0a617 !important">
        <div style="padding-top: .25rem !important; padding-bottom: .25rem !important; justify-content: center !important;display: flex !important; align-content: center; align-items: center; margin: 0 auto;">
            <img src="https://ganaconandreaaular.com/assets/images/logos/logo.png" width="200" style="width: 200px; margin: 0 auto; align-content: center; align-items: center;" />
        </div>
    </div>
</body>
</html>