<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EthicalImpactMetric extends Model
{
    protected $fillable = [
        'wallet_id',
        'metric_type',
        'value',
        'unit',
        'verification_data'
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'verification_data' => 'array'
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }
}