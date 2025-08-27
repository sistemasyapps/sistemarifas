<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Exception;
use Carbon\Carbon;

class SendWhatsappJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $datos;

    /**
     * Create a new job instance.
     */
    public function __construct($datos)
    {
        $this->datos = $datos;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try{
            $urlIndex = 0;
            if(Cache::has('whatsapp_url_index')){
                // Log::info('entro por aqui por el if Cache::has');
                $urlIndex = Cache::get('whatsapp_url_index');
            }else{
                // Log::info('entro por aqui por el if Cache::forever');
                Cache::forever('whatsapp_url_index',0);
            }
            
            $urlIndex = $urlIndex & 1;

            $urls = [
                "https://api.ultramsg.com/instance100118/messages/chat",
                "https://api.ultramsg.com/instance100119/messages/chat"
            ];

            $tokens = [
                "j60mpex4efvba51y",
                "2nn16fbnp4tsuwic"
            ];

            $client = new Client();
            $headers = [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ];
            $params=array(
                'token' => $tokens[$urlIndex],
                'to' => $this->datos['to'],
                'body' => $this->datos['message']
            );
            $options = ['form_params' =>$params ];
            $request = new Request(
                method: 'POST',
                uri: $urls[$urlIndex],
                headers: $headers
            );
            $res = $client->sendAsync($request, $options)->wait();

            Cache::increment('whatsapp_url_index');
            $urlIndex = Cache::get('whatsapp_url_index');
            Log::info('valor del urlIndex'.$urlIndex);

            Log::info('Envio del whatsapp: '.$res->getBody());
        }catch(RequestException $e) {
            Log::error("Fallo envio del whatsapp: ".$e->getMessage());
        }
    }
}
