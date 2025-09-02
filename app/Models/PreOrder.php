<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
    use HasFactory;

    protected $table = 'pre_orders';

    protected $fillable = [
        'uuid',
        'raffle_id',
        'cantidad',
        'cedula',
        'nombre_completo',
        'correo',
        'telefono',
        'bank_code',
        'monto',
        'IP',
    ];
}

