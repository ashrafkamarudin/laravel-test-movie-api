<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theatre extends Model
{
    use HasFactory;

    public function showtimes(): HasMany
    {
        return $this->hasMany(Showtime::class);
    }
}
