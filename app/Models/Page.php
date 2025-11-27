<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'section_id',
        'title',
        'slug',
        'content',
        'documents',
        'images',
        'links',
        'status',
    ];

    protected $casts = [
        'documents' => 'array',
        'images' => 'array',
        'links' => 'array',
        'status' => 'boolean',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
