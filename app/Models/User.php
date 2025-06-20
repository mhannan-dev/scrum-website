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
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'position',
        'email',
        'password',
        'type',                // New field added
        'can_login',           // New field added
        'slug',                // New field added
        'image',               // New field added
        'social_links',       // New field added
        'category_id',        // New field added
        'status',             // New field added
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    /**
     * Get the category that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // protected $appends = ['category_data'];
    protected $casts = [
        'social_links' => 'array', // ensures JSON is returned as array
    ];


    // public function getCategoryDataAttribute()
    // {
    //     return $this->category()->exists()
    //         ? [
    //             'id' => $this->category->id,
    //             'title' => $this->category->title,
    //             'slug' => $this->category->slug,
    //         ]
    //         : null;
    // }
}
