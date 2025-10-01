<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegenerativeCredit extends Model
{
    protected $fillable = [
        'user_id',
        'transaction_id',
        'amount',
        'impact_score',
        'type',
        'status',
        'verification_data'
    ];

    protected $casts = [
        'amount' => 'decimal:8',
        'impact_score' => 'float',
        'verification_data' => 'array'
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
