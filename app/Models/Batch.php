<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 'title', 'start_date', 'end_date',
        'start_time', 'end_time', 'timezone', 'location',
        'price', 'discounted_price', 'slug','user_id','status' // ← Add slug here
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants');
    }

    protected static function booted()
    {
        static::creating(function ($batch) {
            if (empty($batch->slug)) {
                $baseSlug = Str::slug($batch->title);
                $slug = $baseSlug;
                $count = 1;

                while (Batch::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }

                $batch->slug = $slug;
            }
        });
    }
}
