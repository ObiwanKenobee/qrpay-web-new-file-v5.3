<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WildResilienceNode extends Model
{
    protected $fillable = [
        'dome_status', 'wildlife_therapy', 'peace_garden', 'guardian_network', 'symbol_status'
    ];
    protected $casts = [
        'dome_status' => 'array',
        'wildlife_therapy' => 'array',
        'peace_garden' => 'array',
        'guardian_network' => 'array',
        'symbol_status' => 'array',
    ];
}
