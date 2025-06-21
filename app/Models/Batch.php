<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'timezone',
        'location',
        'price',
        'duration',
        'schedule',
        'discounted_price',
        'slug',
        'user_id',
        'status'
    ];

    // protected $appends = ['duration'];

    // public function getDurationAttribute()
    // {
    //     // Ensure Carbon instances
    //     $startDate = \Carbon\Carbon::parse($this->start_date);
    //     $endDate = \Carbon\Carbon::parse($this->end_date);

    //     // If both times exist, combine them with dates
    //     if ($this->start_time && $this->end_time) {
    //         $start = \Carbon\Carbon::parse($this->start_date . ' ' . $this->start_time);
    //         $end = \Carbon\Carbon::parse($this->end_date . ' ' . $this->end_time);
    //     }
    //     // Only start_time is present
    //     elseif ($this->start_time && !$this->end_time) {
    //         $start = \Carbon\Carbon::parse($this->start_date . ' ' . $this->start_time);
    //         $end = $endDate->endOfDay();
    //     }
    //     // Only end_time is present
    //     elseif (!$this->start_time && $this->end_time) {
    //         $start = $startDate->startOfDay();
    //         $end = \Carbon\Carbon::parse($this->end_date . ' ' . $this->end_time);
    //     }
    //     // No times provided, use full dates
    //     else {
    //         $start = $startDate->startOfDay();
    //         $end = $endDate->endOfDay();
    //     }

    //     // Handle cases where end is before start
    //     if ($end < $start) {
    //         return 'Invalid duration';
    //     }

    //     // Get diff in days, hours, minutes
    //     $diff = $start->diff($end);

    //     // Format into readable string
    //     return trim(sprintf('%d days %d hours %d minutes',
    //         $diff->d + ($diff->m * 30) + ($diff->y * 365),
    //         $diff->h,
    //         $diff->i
    //     ));
    // }

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


    public function scopeUpcoming($query)
    {
        return $query->whereDate('start_date', '>=', now())->orderBy('start_date');
    }


    /**
     * Get the user that owns the Batch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trainer()
    {
        return $this->belongsTo(User::class, 'user_id')->where('type', 'trainer');
    }
}
