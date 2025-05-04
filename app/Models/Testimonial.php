<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonials';

    // The attributes that are mass assignable
    protected $fillable = [
        'user_id',
        'comment',
        'image',
        'designation'
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'comment' => 'string',
        'image' => 'string',
        'designation' => 'string',
    ];


    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    /**
     * Define a relationship with the User model (assuming user_id is the foreign key)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Optional: Custom setter to handle storing the image
     * You can store image path here and customize the storage process if needed.
     */
    public function setImageAttribute($value)
    {
        if (is_object($value)) {
            $this->attributes['image'] = $value->store('testimonials', 'public');
        } elseif (is_string($value)) {
            $this->attributes['image'] = $value;
        }
    }
}
