<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificacionBanco extends Model
{
    use HasFactory;

    protected $table = 'notificacion_banco';

    protected $fillable = [
        'request',
        'reintentos',
    ];

    protected $casts = [
        'request' => 'string',
        'reintentos' => 'int',
    ];
}
