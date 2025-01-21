<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}} - Gran Sorteo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{asset('assets/css/home.css')}}?ver=1.0.0" rel="stylesheet">
</head>
<body style="height: 100vh; display: flex; align-items: center;">
    <main class="container">
        <section class="sorteo-info">
            <div class="row">
                <div class="imagen medio">
                    <!-- <img src="/assets/images/info/premios.png?" alt="Premios" loading="lazy" class="w-100 w-lg-75 img-fluid"> -->
                </div>
            </div>
        </section>
        <div class="comprar-tickets">
            <h2>En mantenimiento, estamos trabajando en tu sorpresa...</h2>
        </div>
    </main>
    
    <a href="https://wa.me/{{$whatsapp}}" class="whatsapp" target="_blank"> 
        <img src="/assets/images/icon/whatsapp.png"/>
    </a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>