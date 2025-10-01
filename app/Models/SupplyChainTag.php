<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupplyChainTag extends Model
{
    protected $fillable = [
        'transaction_id',
        'name',
        'value',
        'category',
        'verification_level',
        'verified_by',
        'verification_date',
        'metadata'
    ];

    protected $casts = [
        'verification_date' => 'datetime',
        'metadata' => 'array'
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function children(): HasMany
    {
        return $this->hasMany(SupplyChainTag::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(SupplyChainTag::class, 'parent_id');
    }
}
