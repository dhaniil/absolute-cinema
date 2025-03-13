<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Genre;

class Film extends Model
{
    /** @use HasFactory<\Database\Factories\FilmFactory> */
    use HasFactory;

    protected $table = 'films';
    protected $fillable = ['user_id', 'genre_id', 'title', 'slug','synopsis', 'trailer_url', 'poster', 'release_year'];

    protected $casts = [
        'genre_id' => 'array',
    ];

    protected function genres(): Attribute
    {
        return Attribute::get(function () {
            $genreIds = $this->genre_id;

            // Jika genre_id berupa string (misal: "1"), ubah menjadi array ["1"]
            if (is_string($genreIds)) {
                $genreIds = [$genreIds];
            }

            // Jika masih string JSON, decode ke array
            if (is_string($genreIds) && str_starts_with($genreIds, '[')) {
                $genreIds = json_decode($genreIds, true) ?? [];
            }

            return Genre::whereIn('id', $genreIds)->pluck('name');
        });
    }

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
