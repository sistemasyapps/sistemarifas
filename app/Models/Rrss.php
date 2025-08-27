<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rrss extends Model
{
    protected $fillable = ["tipo","link","estatus"];

    use HasFactory;
}
