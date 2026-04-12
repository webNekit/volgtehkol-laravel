<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'is_header' => 'boolean',
        'is_footer' => 'boolean',
    ];

    public function departament(): BelongsTo
    {
        return $this->belongsTo(ContactDepartament::class, 'contact_departament_id');
    }
}
