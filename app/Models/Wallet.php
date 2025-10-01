<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'balance',
        'currency',
        'status',
        'is_primary',
        'type',
        'settings'
    ];

    protected $casts = [
        'settings' => 'array',
        'is_primary' => 'boolean',
        'balance' => 'decimal:8'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sentTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'sender_wallet_id');
    }

    public function receivedTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'receiver_wallet_id');
    }

    public function ethicalImpactMetrics(): HasMany
    {
        return $this->hasMany(EthicalImpactMetric::class);
    }

    public function communityBonds(): HasMany
    {
        return $this->hasMany(CommunityBond::class);
    }
}