<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title',
        'parent_id',
        'slug',
        'meta_title',
        'meta_description',
        'status',
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    protected static function booted()
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $baseSlug = Str::slug($category->title);
                $slug = $baseSlug;
                $count = 1;

                while (Category::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }

                $category->slug = $slug;
            }
        });
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
