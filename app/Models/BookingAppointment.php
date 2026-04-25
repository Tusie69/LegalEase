<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingAppointment extends Model
{
    protected $table = 'booking_appointments';

    protected $fillable = [
        'booking_code',
        'customer_user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'booking_lawyer_id',
        'booking_time_slot_id',
        'appointment_start_at',
        'appointment_end_at',
        'issue_summary',
        'status',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'appointment_start_at' => 'datetime',
            'appointment_end_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    public function lawyer(): BelongsTo
    {
        return $this->belongsTo(BookingLawyer::class, 'booking_lawyer_id');
    }

    public function timeSlot(): BelongsTo
    {
        return $this->belongsTo(BookingTimeSlot::class, 'booking_time_slot_id');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'CONFIRMED' => 'Đã xác nhận',
            'CANCELLED' => 'Đã hủy',
            'PENDING' => 'Chờ xác nhận',
            'COMPLETED' => 'Đã hoàn thành',
            default => $this->status,
        };
    }
}
