<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    protected $fillable = [
        'title',
        'top_button_text',
        'description',
        'image',
        // 'big_button',
        'main_button_text',
        'main_button_link',
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
