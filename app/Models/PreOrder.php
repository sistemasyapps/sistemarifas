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
        'metodo_pago_id',
        'monto',
        'IP',
    ];

    protected static function booted()
    {
        static::saving(function (PreOrder $pre) {
            if (!empty($pre->bank_code)) {
                $pre->bank_code_last3 = substr((string) $pre->bank_code, -3);
            }
        });
    }
}
