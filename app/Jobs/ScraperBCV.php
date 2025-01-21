<?php

namespace App\Jobs;

use Goutte\Client;
use App\Models\Option;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScraperBCV implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $client = new Client();
        // $crawler = $client->request('GET', 'https://www.bcv.org.ve/');

        // $dollarPrice = $crawler->filter('#dolar .recuadrotsmc .centrado strong')->text();

        // $dollarPrice = str_replace(',', '.', $dollarPrice);
        // $dolar = number_format($dollarPrice,2);
        // $dolar += 1.5;
        $dolar = 40;

        Option::updateOrCreate(
            ['clave' => 'BCV'],
            ['valor' => $dolar]
        );
    }
}
