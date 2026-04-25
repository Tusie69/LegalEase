<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookingLawyer extends Model
{
    protected $table = 'booking_lawyers';

    protected $fillable = [
        'display_name',
        'specialty',
        'location',
        'experience_years',
        'consultation_fee',
        'rating',
        'bio',
        'avatar_initials',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'consultation_fee' => 'decimal:2',
            'rating' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function timeSlots(): HasMany
    {
        return $this->hasMany(BookingTimeSlot::class, 'booking_lawyer_id');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(BookingAppointment::class, 'booking_lawyer_id');
    }
}
