<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Raffle extends Model
{
    use HasFactory;

    protected $fillable = ["cantidad_max","nombre","precio","fecha_inicial","fecha_final","descripcion","imagen_texto","imagen_premio","imagen_banner","estatus"];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function winners(): HasMany
    {
        return $this->hasMany(Winner::class);
    }

    
}
