<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageAttachment extends Model
{
    protected $guarded = [];
    protected $casts = ['is_visible' => 'boolean'];
    public function attachable() { return $this->morphTo(); }
}
