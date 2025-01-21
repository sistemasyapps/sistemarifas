<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Winner extends Model
{
    protected $fillable = ["raffle_id"];

    use HasFactory;

    public function raffle(): BelongsTo
    {
        return $this->belongsTo(Raffle::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(WinnerPhotos::class);
    }  
   
}
