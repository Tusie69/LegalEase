<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingTimeSlot extends Model
{
    protected $table = 'booking_time_slots';

    protected $fillable = [
        'booking_lawyer_id',
        'start_at',
        'end_at',
        'is_booked',
    ];

    protected function casts(): array
    {
        return [
            'start_at' => 'datetime',
            'end_at' => 'datetime',
            'is_booked' => 'boolean',
        ];
    }

    public function lawyer(): BelongsTo
    {
        return $this->belongsTo(BookingLawyer::class, 'booking_lawyer_id');
    }
}
