<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingTimeSlot extends Model
{
    protected $table = 'slots';

    protected $fillable = [
        'lawyer_id',
        'start_time',
        'end_time',
        'status',
        'locked_by_user_id',
        'locked_at',
        'lock_expires_at',
    ];

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
            'locked_at' => 'datetime',
            'lock_expires_at' => 'datetime',
        ];
    }

    public function lawyer(): BelongsTo
    {
        return $this->belongsTo(BookingLawyer::class, 'lawyer_id');
    }

    public function getStartAtAttribute()
    {
        return $this->start_time;
    }

    public function getEndAtAttribute()
    {
        return $this->end_time;
    }

    public function getIsBookedAttribute(): bool
    {
        return $this->status === 'BOOKED';
    }
}
