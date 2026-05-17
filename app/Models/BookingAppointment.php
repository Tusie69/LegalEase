<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookingAppointment extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'booking_code',
        'lawyer_id',
        'customer_id',
        'slot_id',
        'status',
        'consultation_topic',
        'consultation_summary',
        'scheduled_start_at',
        'scheduled_end_at',
        'timezone',
        'price_amount',
        'deposit_amount',
        'final_amount',
        'customer_note',
        'paid_at',
        'completed_at',
        'cancelled_at',
        'cancelled_by_user_id',
        'cancellation_reason',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_start_at' => 'datetime',
            'scheduled_end_at' => 'datetime',
            'paid_at' => 'datetime',
            'completed_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    public function lawyer(): BelongsTo
    {
        return $this->belongsTo(BookingLawyer::class, 'lawyer_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function timeSlot(): BelongsTo
    {
        return $this->belongsTo(BookingTimeSlot::class, 'slot_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'appointment_id');
    }

    public function getAppointmentStartAtAttribute()
    {
        return $this->scheduled_start_at;
    }

    public function getAppointmentEndAtAttribute()
    {
        return $this->scheduled_end_at;
    }

    public function getCustomerNameAttribute(): string
    {
        return (string) ($this->customer?->name ?? 'Khach hang');
    }

    public function getCustomerEmailAttribute(): string
    {
        return (string) ($this->customer?->email ?? '-');
    }

    public function getCustomerPhoneAttribute(): string
    {
        return (string) ($this->customer?->phone ?? '-');
    }

    public function getIssueSummaryAttribute(): ?string
    {
        return $this->consultation_summary;
    }

    public function getBookingTimeSlotIdAttribute(): ?int
    {
        return $this->slot_id;
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'CONFIRMED' => 'Da xac nhan',
            'CANCELLED' => 'Da huy',
            'PENDING' => 'Cho xac nhan',
            'PAYMENT_PENDING' => 'Cho thanh toan',
            'COMPLETED' => 'Da hoan thanh',
            default => (string) $this->status,
        };
    }
}
