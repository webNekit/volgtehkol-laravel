<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $guarded = [];

    protected $casts = [
      'is_active' => 'boolean',
      'is_banner' => 'boolean',
      'is_slider' => 'boolean',
        'direction' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function format(): BelongsTo
    {
        return $this->belongsTo(EventFormat::class, 'event_format_id');
    }
}
