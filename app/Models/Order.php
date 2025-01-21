<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{   
    use HasFactory;

    protected $fillable = ["raffle_id","client_id","precio_dolar","cantidad","ref_imagen","IP","city_id","uuid","ref_banco"];

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
}
