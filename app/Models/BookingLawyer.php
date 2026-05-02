<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BookingLawyer extends Model
{
    protected $table = 'users';

    protected $appends = [
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

    public function scopeLawyer(Builder $query): Builder
    {
        return $query->where('role_id', 2);
    }

    public function lawyerProfile(): HasOne
    {
        return $this->hasOne(LawyerProfile::class, 'user_id');
    }

    public function timeSlots(): HasMany
    {
        return $this->hasMany(BookingTimeSlot::class, 'lawyer_id');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(BookingAppointment::class, 'lawyer_id');
    }

    public function getDisplayNameAttribute(): string
    {
        return (string) $this->name;
    }

    public function getSpecialtyAttribute(): string
    {
        $expertise = (string) ($this->lawyerProfile?->expertise ?? 'Tu van phap ly tong quat');
        return trim(explode(',', $expertise)[0]);
    }

    public function getLocationAttribute(): string
    {
        return 'Viet Nam';
    }

    public function getExperienceYearsAttribute(): int
    {
        return (int) ($this->lawyerProfile?->years_of_experience ?? 0);
    }

    public function getConsultationFeeAttribute(): float
    {
        return (float) ($this->lawyerProfile?->consultation_fee ?? 0);
    }

    public function getRatingAttribute(): float
    {
        return (float) ($this->lawyerProfile?->rating ?? 5);
    }

    public function getBioAttribute(): string
    {
        return (string) ($this->lawyerProfile?->bio ?? '');
    }

    public function getAvatarInitialsAttribute(): string
    {
        $parts = preg_split('/\s+/', trim((string) $this->name));
        $a = strtoupper(substr($parts[0] ?? 'L', 0, 1));
        $b = strtoupper(substr($parts[1] ?? 'S', 0, 1));
        return $a . $b;
    }

    public function getIsActiveAttribute(): bool
    {
        return $this->status === 'ACTIVE' && (bool) ($this->lawyerProfile?->is_search_visible ?? true);
    }
}
