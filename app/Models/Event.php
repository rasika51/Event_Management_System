<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'max_participants',
        'status',
        'user_id',
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    /**
     * Get the user that owns the event
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for active events
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for upcoming events
     */
    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>', now());
    }
}