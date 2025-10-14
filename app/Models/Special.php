<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Special extends Model
{
    protected $guarded = [];
    protected $casts = [
        'cost' => 'float',
        'is_active' => 'boolean',
        'is_banner' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(SpecialCategory::class, 'special_category_id');
    }
}
