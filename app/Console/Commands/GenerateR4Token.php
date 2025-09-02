<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateR4Token extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Example:
     *  php artisan r4:gen-token 123
     */
    protected $signature = 'r4:gen-token {commerceId : ID del comercio}';

    /**
     * The console command description.
     */
    protected $description = 'Genera un UUID (R4_AUTH_TOKEN) para usar en los headers Authorization de R4';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $commerceId = (string) $this->argument('commerceId');

        if ($commerceId === '') {
            $this->error('Debe indicar el ID del comercio');
            return self::FAILURE;
        }

        $uuid = (string) Str::uuid();

        $this->info('UUID_DEL_COMERCIO generado correctamente');
        $this->line('');
        $this->line("Comercio ID: {$commerceId}");
        $this->line("Token (UUID): {$uuid}");
        $this->line('');
        $this->line('Agregue esta línea a su .env:');
        $this->line("R4_AUTH_TOKEN={$uuid}");
        $this->line('');
        $this->line('Luego, reinicie la app para que tome el valor del .env.');

        return self::SUCCESS;
    }
}
