<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityBond extends Model
{
    protected $fillable = [
        'user_id', 'apy', 'investment', 'currency', 'impact_stats'
    ];
}
