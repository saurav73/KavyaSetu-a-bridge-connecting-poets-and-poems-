<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ────────────────────────────────────────────────
    //  Relationships
    // ────────────────────────────────────────────────

    /**
     * Get all poems written by this user
     */
    public function poems()
    {
        return $this->hasMany(Poem::class);
    }

    // Optional: if you add likes later
    // public function likes()
    // {
    //     return $this->hasMany(Like::class);
    // }

    // Optional: if you add comments later
    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }
}