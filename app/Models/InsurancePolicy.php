<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InsurancePolicy extends Model
{
    protected $fillable = [
        'user_id',
        'transaction_id',
        'premium_amount',
        'coverage_amount',
        'currency',
        'status',
        'start_date',
        'end_date',
        'type',
        'claim_date',
        'claim_amount',
        'claim_reason',
        'claim_evidence',
        'metadata'
    ];

    protected $casts = [
        'premium_amount' => 'decimal:8',
        'coverage_amount' => 'decimal:8',
        'claim_amount' => 'decimal:8',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'claim_date' => 'datetime',
        'metadata' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}