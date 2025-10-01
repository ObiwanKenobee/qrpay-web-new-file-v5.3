<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpactWallet extends Model
{
    protected $fillable = [
        'user_id', 'balance', 'currency', 'recent_aid', 'redeemed_at'
    ];
    protected $casts = [
        'recent_aid' => 'array',
        'redeemed_at' => 'datetime',
    ];
}
