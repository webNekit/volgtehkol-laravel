<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModulePage extends Model
{
    protected $guarded = [];

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
}
