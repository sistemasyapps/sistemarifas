<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Raffle;

class Option extends Model
{

    protected $fillable = ["clave","valor"];

    use HasFactory;

    protected static function booted()
    {
        Raffle::clearActiveRafflesCache();
    }
}
