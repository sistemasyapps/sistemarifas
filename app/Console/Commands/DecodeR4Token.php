<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DecodeR4Token extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Example:
     *  php artisan r4:decode-token
     *  php artisan r4:decode-token 123e4567-e89b-12d3-a456-426614174000
     */
    protected $signature = 'r4:decode-token {token? : Token a verificar (opcional, por defecto usa R4_AUTH_TOKEN)}';

    /**
     * The console command description.
     */
    protected $description = 'Valida y muestra el token R4_AUTH_TOKEN. Nota: es un UUID en texto plano, no requiere desencriptado';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $token = (string) ($this->argument('token') ?? env('R4_AUTH_TOKEN'));

        if ($token === '') {
            $this->error('No se proporcionó token ni existe R4_AUTH_TOKEN en el entorno');
            return self::FAILURE;
        }

        $uuidRegex = '/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}$/';
        $isUuid = (bool) preg_match($uuidRegex, $token);

        $this->info('Token R4 (Authorization header)');
        $this->line("Valor: {$token}");
        $this->line('');
        if ($isUuid) {
            $this->info('Formato: UUID válido');
            $this->line('El token no está encriptado; se usa tal cual en el header Authorization.');
        } else {
            $this->warn('El formato no coincide con UUID. Verifique que cumple 8-4-4-4-12 hex.');
        }

        return self::SUCCESS;
    }
}

