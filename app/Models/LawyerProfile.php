<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LawyerProfile extends Model
{
    protected $table = 'lawyer_profiles';

    protected $fillable = [
        'user_id',
        'years_of_experience',
        'consultation_fee',
        'rating',
        'expertise',
        'bio',
        'verification_status',
        'is_search_visible',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

