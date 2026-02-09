<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Poem extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'body',
        'slug',
        'is_published',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_published' => 'boolean',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'deleted_at'   => 'datetime',
    ];

    // ────────────────────────────────────────────────
    //  Boot / Lifecycle Hooks
    // ────────────────────────────────────────────────

    protected static function booted(): void
    {
        static::creating(function (Poem $poem) {
            if (empty($poem->slug)) {
                $poem->slug = Str::slug($poem->title) . '-' . substr(uniqid(), -6);
            }
        });

        static::updating(function (Poem $poem) {
            if ($poem->isDirty('title') && ! $poem->isDirty('slug')) {
                $poem->slug = Str::slug($poem->title) . '-' . substr(uniqid(), -6);
            }
        });
    }

    // ────────────────────────────────────────────────
    //  Relationships
    // ────────────────────────────────────────────────

    /**
     * The user who wrote this poem
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Optional future relationships
    // public function likes()
    // {
    //     return $this->hasMany(Like::class);
    // }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }

    // ────────────────────────────────────────────────
    //  Accessors / Helpers
    // ────────────────────────────────────────────────

    /**
     * Get a short excerpt for previews/cards
     */
    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->body), 160);
    }

    /**
     * Get approximate reading time in minutes
     */
    public function getReadingTimeAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->body));
        return max(1, (int) ceil($wordCount / 200)); // ~200 words per minute
    }

    /**
     * Check if the current authenticated user is the owner
     */
    public function isOwnedByCurrentUser(): bool
    {
        return auth()->check() && $this->user_id === auth()->id();
    }
}