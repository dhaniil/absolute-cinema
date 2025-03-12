<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    /** @use HasFactory<\Database\Factories\FilmFactory> */
    use HasFactory;

    protected $table = 'films';
    protected $fillable = ['user_id', 'genre_id', 'title', 'slug','synopsis', 'trailer_url', 'poster', 'release_year'];

    protected $casts = [
        'genre_id' => 'array',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function genre(): HasMany
    {
        return $this->hasMany(Genre::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

}
