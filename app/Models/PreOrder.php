<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\MetodoPago;
use App\Models\Order;

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
        'fingerprint',
        'consumida_at',
    ];

    protected $casts = [
        'consumida_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::saving(function (PreOrder $pre) {
            if (!empty($pre->bank_code)) {
                $pre->bank_code_last3 = substr((string) $pre->bank_code, -3);
            }
        });
    }

    public static function fingerprintFor(array $attributes): string
    {
        $fields = [
            $attributes['raffle_id'] ?? '',
            $attributes['cantidad'] ?? '',
            $attributes['cedula'] ?? '',
            strtolower((string) ($attributes['correo'] ?? '')),
            $attributes['telefono'] ?? '',
            $attributes['metodo_pago_id'] ?? '',
            number_format((float) ($attributes['monto'] ?? 0), 2, '.', ''),
        ];

        return hash('sha256', implode('|', $fields));
    }

    public function metodoPago(): BelongsTo
    {
        return $this->belongsTo(MetodoPago::class);
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class, 'pre_order_id');
    }
}
