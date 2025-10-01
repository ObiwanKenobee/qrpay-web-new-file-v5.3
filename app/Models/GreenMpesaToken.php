<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GreenMpesaToken extends Model
{
    protected $fillable = [
        'user_id', 'eco_tokens', 'impact'
    ];
}
