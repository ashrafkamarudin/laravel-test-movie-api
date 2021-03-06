<?php

namespace App\Models;

use App\Models\{Genre, Timeslot};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{HasMany, BelongsToMany};
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
    */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

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

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function getOverallRatingAttribute()
    {
        return $this->ratings()->avg('rating');
    }
}
