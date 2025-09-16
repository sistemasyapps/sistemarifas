<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Raffle extends Model
{
    use HasFactory;

    protected $fillable = ["cantidad_max","nombre","precio","fecha_inicial","fecha_final","mensaje_proximo_sorteo","descripcion","imagen_texto","imagen_premio","imagen_banner","estatus","estatus_compra"];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function winners(): HasMany
    {
        return $this->hasMany(Winner::class);
    }

    protected static function booted()
    {
        static::updated(function ($raffle) {
            self::clearActiveRafflesCache();
        });

        static::created(function ($raffle) {
            self::clearActiveRafflesCache();
        });
    }

    public static function clearActiveRafflesCache()
    {
        Cache::forget("active_raffle");
    }

    
}
