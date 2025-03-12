<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = ['user_id', 'film_id', 'content'];

    public function film(): HasMany
    {
        return $this->hasMany(Film::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
