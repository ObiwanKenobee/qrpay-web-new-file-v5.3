<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerificationRecord extends Model
{
    protected $fillable = [
        'transaction_id',
        'verifier_type',
        'verification_status',
        'verification_data',
        'verified_at'
    ];

    protected $casts = [
        'verification_data' => 'array',
        'verified_at' => 'datetime'
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}