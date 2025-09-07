<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Console\Events\CommandStarting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Bloquear comandos peligrosos fuera de testing, a menos que se permita explícitamente
        if ($this->app->runningInConsole()) {
            Event::listen(CommandStarting::class, function (CommandStarting $event): void {
                $cmd = (string) ($event->command ?? '');
                if ($cmd === '') return;

                $dangerous = ['migrate:fresh', 'migrate:reset', 'db:wipe'];
                $allow = filter_var(env('ALLOW_DANGEROUS_MIGRATIONS', false), FILTER_VALIDATE_BOOL);
                $isTesting = app()->environment('testing');

                if (in_array($cmd, $dangerous, true) && !$isTesting && !$allow) {
                    throw new \RuntimeException("Comando bloqueado: '{$cmd}'. Establézcase ALLOW_DANGEROUS_MIGRATIONS=true bajo su propia responsabilidad o use entorno 'testing'.");
                }
            });
        }
    }
}
