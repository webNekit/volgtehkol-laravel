<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModulePage extends Model
{
    protected $guarded = [];
    protected $casts = [
        'images' => 'array',
        'files' => 'array',
        'links' => 'array',
    ];
}
