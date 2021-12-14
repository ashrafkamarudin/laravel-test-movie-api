<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Timeslot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    use HasFactory;

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function timeslot(): HasMany
    {
        return $this->hasMany(Timeslot::class);
    }

    public function performers(): BelongsToMany
    {
        return $this->belongsToMany(Performer::class);
    }
}
