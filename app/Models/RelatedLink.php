<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedLink extends Model
{
    protected $guarded = [];
    protected $casts = ['is_visible' => 'boolean'];
    public function linkable() { return $this->morphTo(); }
}
