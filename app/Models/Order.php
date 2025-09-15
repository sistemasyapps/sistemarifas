<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\MetodoPago;

class Order extends Model
{   
    use HasFactory;

    protected $fillable = [
        "raffle_id",
        "client_id",
        "pre_order_id",
        "precio_dolar",
        "cantidad",
        "ref_imagen",
        "ref_fecha",
        "IP",
        "city_id",
        "uuid",
        "ref_banco",
        "bank_code",
        "metodo_pago_id",
        "monto_notificado_bs",
        "fecha_pago_notificado",
        // Datos del emisor del pago (nullable por compatibilidad)
        'emisor_cedula',
        'emisor_telefono',
    ];

    public function raffle(): BelongsTo
    {
        return $this->belongsTo(Raffle::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function numbers(): HasMany
    {
        return $this->hasMany(OrderNumber::class);
    }   

    public function metodoPago(): BelongsTo
    {
        return $this->belongsTo(MetodoPago::class);
    }
}
