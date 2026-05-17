<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'appointment_id',
        'submitted_by_user_id',
        'reviewed_by_user_id',
        'amount',
        'payment_type',
        'payment_method',
        'bank_name',
        'transfer_reference',
        'customer_note',
        'admin_note',
        'status',
        'transaction_id',
        'submitted_at',
        'reviewed_at',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'submitted_at' => 'datetime',
            'reviewed_at' => 'datetime',
            'paid_at' => 'datetime',
        ];
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(BookingAppointment::class, 'appointment_id');
    }
}
