<?php

// namespace App\Console\Commands;

// use Illuminate\Console\Command;
// use Ratchet\Server\IoServer;
// use Ratchet\Http\HttpServer;
// use Ratchet\WebSocket\WsServer;
// use React\EventLoop\Factory;
// use React\Socket\SecureServer;
// use React\Socket\TcpServer;
// use App\Services\ProgressWebSocketHandler;

// class WebSocketServer extends Command
// {
//     protected $signature = 'websocket:serve {--port=2053} {--demo}';
//     protected $description = 'Iniciar servidor WebSocket seguro con SSL';

//     public function handle()
//     {
//         $port = $this->option('port');
//         $demo = $this->option('demo');

//         $certPath = '/etc/letsencrypt/archive/rifaalvarado.yapirides.com/fullchain1.pem';
//         $keyPath = '/etc/letsencrypt/archive/rifaalvarado.yapirides.com/privkey1.pem';
        
//         // Añade verificación de permisos
//         if (!is_readable($certPath)) {
//             $this->error("No se puede leer el certificado: $certPath");
//             return 1;
//         }
        
//         if (!is_readable($keyPath)) {
//             $this->error("No se puede leer la clave privada: $keyPath");
//             return 1;
//         }

//         $this->info("Certificados SSL encontrados");

//         try {
//             $loop = Factory::create();
//             $webSocket = new ProgressWebSocketHandler($demo);

//             // Configuración del servidor TCP
//             $socket = new TcpServer("0.0.0.0:{$port}", $loop);

//             // Configuración SSL detallada
//             $secureSocket = new SecureServer($socket, $loop, [
//                 'local_cert' => $certPath,
//                 'local_pk' => $keyPath,
//                 'verify_peer' => false,
//                 'allow_self_signed' => false,
//                 'security_level' => 1,
//                 'verify_depth' => 5,
//                 'ciphers' => 'ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES256-GCM-SHA384:ECDHE-ECDSA-AES256-GCM-SHA384',
//                 'SNI_enabled' => true,
//                 'disable_compression' => true
//             ]);

//             $server = new IoServer(
//                 new HttpServer(
//                     new WsServer($webSocket)
//                 ),
//                 $secureSocket
//             );

//             $this->info("Servidor WebSocket Seguro iniciado en puerto {$port}");
            
//             // Manejador de errores para el socket seguro
//             $secureSocket->on('error', function ($error) {
//                 $this->error("Error SSL: " . $error->getMessage());
//             });

//             $loop->run();

//         } catch (\Exception $e) {
//             $this->error("Error fatal: " . $e->getMessage());
//             return 1;
//         }
//     }
// }