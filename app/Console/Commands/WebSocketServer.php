<?php

// namespace App\Console\Commands;

// use App\Models\Raffle;
// use Illuminate\Console\Command;
// use Ratchet\Server\IoServer;
// use Ratchet\Http\HttpServer;
// use Ratchet\WebSocket\WsServer;
// use React\EventLoop\Factory;
// use React\Socket\SecureServer;
// use React\Socket\TcpServer;
// use App\Services\ProgressWebSocketHandler;
// use App\Services\RaffleService;

// class WebSocketServer extends Command
// {
//     protected $signature = 'websocket:serve {--port=2053} {--demo}';
//     protected $description = 'Iniciar servidor WebSocket seguro con SSL';
    
//     // IDs específicos de las rifas que deseas mostrar
//     private $raffleId = [9];

//     public function handle(RaffleService $raffleService)
//     {
//         $port = $this->option('port');
//         $certPath = '/etc/letsencrypt/archive/rifaalvarado.yapirides.com/fullchain1.pem';
//         $keyPath = '/etc/letsencrypt/archive/rifaalvarado.yapirides.com/privkey1.pem';

//         if (!is_readable($certPath) || !is_readable($keyPath)) {
//             $this->error("No se pueden leer los certificados SSL.");
//             return 1;
//         }

//         $this->info("Certificados SSL encontrados");

//         $loop = Factory::create();

//         $webSock = new TcpServer("0.0.0.0:$port", $loop);
//         $secureWebSock = new SecureServer($webSock, $loop, [
//             'local_cert' => $certPath,
//             'local_pk'   => $keyPath,
//             'allow_self_signed' => true,
//             'verify_peer' => false
//         ]);

//         $handler = new ProgressWebSocketHandler();
//         $wsServer = new WsServer($handler);
//         $httpServer = new HttpServer($wsServer);

//         $server = new IoServer($httpServer, $secureWebSock, $loop);

//         // Consulta periódica solo para rifas con IDs en $raffleId
//         $loop->addPeriodicTimer(2, function () use ($raffleService, $handler) {
//             $data = $this->getUpdatedData($raffleService);
//             if ($data) {
//                 $handler->broadcast($data);
//             }
//         });

//         $this->info("Servidor WebSocket iniciado en el puerto {$port}");
//         $loop->run();
//     }

//     private function getUpdatedData(RaffleService $raffleService)
//     {
//         // Limitar la consulta a los IDs especificados en $raffleId
//         $raffles = Raffle::whereIn('id', $this->raffleId)->get()->map(function ($raffle) use ($raffleService) {
//             return [
//                 'id'    => $raffle->id,
//                 'barra' => $raffleService->getBarra($raffle)->barra,
//                 'queda' => $raffleService->getDisponibles($raffle),
//                 'lastUpdate' => time(),
//             ];
//         });

//         return $raffles->toArray();
//     }
// }
