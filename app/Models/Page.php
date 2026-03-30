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

    public function imageAttachments()
    {
        return $this->morphMany(\App\Models\ImageAttachment::class, 'attachable')->orderBy('sort');
    }

    public function fileAttachments()
    {
        return $this->morphMany(\App\Models\FileAttachment::class, 'attachable')->orderBy('sort');
    }

    public function relatedLinks()
    {
        return $this->morphMany(\App\Models\RelatedLink::class, 'linkable')->orderBy('sort');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
