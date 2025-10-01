<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationBundle extends Model
{
    protected $fillable = [
        'name', 'type', 'curriculum_link'
    ];
}
