<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Staff extends Model
{
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'disciplines' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryStaff::class, 'category_staff_id');
    }
}
