<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistrationMessage extends Model
{
    // Allow mass assignment
    protected $fillable = [
        'user_id',
        'message',
    ];

    /**
     * Get the user that owns the registration message.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
