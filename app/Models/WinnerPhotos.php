<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WinnerPhotos extends Model
{
    protected $fillable = ["winner_id","photo"];

    use HasFactory;

    public function winners(): BelongsTo
    {
        return $this->belongsTo(Winner::class);
    }
   
}
