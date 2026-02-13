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
                $poem->slug = self::generateUniqueSlug($poem->title);
            }
        });

        static::updating(function (Poem $poem) {
            // If the title changed and the slug wasn't manually changed,
            // regenerate a unique slug based on the new title.
            if ($poem->isDirty('title') && ! $poem->isDirty('slug')) {
                $poem->slug = self::generateUniqueSlug($poem->title, $poem->id);
            }
        });
    }

    /**
     * Generate a unique slug for the given title.
     * If $exceptId is provided, exclude that record when checking uniqueness (useful on updates).
     */
    protected static function generateUniqueSlug(string $title, ?int $exceptId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        

        $attempts = 0;
        while (
            self::where('slug', $slug)
                ->when($exceptId, fn($q) => $q->where('id', '!=', $exceptId))
                ->exists()
        ) {
            // Append a short unique suffix and try again
            $slug = $base . '-' . substr(uniqid(), -6);
            $attempts++;
            if ($attempts > 10) {
                // Fallback to random string if many collisions (very unlikely)
                $slug = $base . '-' . Str::random(6);
                break;
            }
        }

        return $slug;
    }

    /**
     * Use `slug` for route model binding by default.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
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