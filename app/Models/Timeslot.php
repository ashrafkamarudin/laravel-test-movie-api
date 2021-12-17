<?php

namespace App\Models;

use App\Models\{Movie, Theatre};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timeslot extends Model
{
    use HasFactory;

    public function theatre(): BelongsTo
    {
        return $this->belongsTo(Theatre::class);
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
