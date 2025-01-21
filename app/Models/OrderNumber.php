<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderNumber extends Model
{
    use HasFactory;

    protected $fillable = ["order_id","numero_generado","raffle_id"];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
