<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Trainer extends Model
{
    protected $fillable = ['name', 'slug', 'social_links', 'category_id','image'];

    protected $appends = ['category_data'];



    protected $casts = [
        'social_links' => 'array', // ensures JSON is returned as array
    ];


    public function getCategoryDataAttribute()
    {
        return $this->category()->exists()
            ? [
                'id' => $this->category->id,
                'title' => $this->category->title,
                'slug' => $this->category->slug,
            ]
            : null;
    }

    protected static function booted()
    {
        static::creating(function ($trainer) {
            if (!$trainer->slug) {
                $trainer->slug = Str::slug($trainer->name) . '-' . now()->timestamp;
            }
        });

        static::updating(function ($trainer) {
            if (!$trainer->slug) {
                $trainer->slug = Str::slug($trainer->name) . '-' . now()->timestamp;
            }
        });
    }

    /**
     * Get the Category that owns the Trainer.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}
