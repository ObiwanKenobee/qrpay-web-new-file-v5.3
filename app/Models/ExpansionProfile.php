<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpansionProfile extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'settings',
        'features',
        'status'
    ];

    protected $casts = [
        'settings' => 'array',
        'features' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}