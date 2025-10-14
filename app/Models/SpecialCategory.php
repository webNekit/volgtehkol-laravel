<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpecialCategory extends Model
{
    protected $guarded = [];
    protected $casts = ['is_active' => 'boolean'];

    public function specials(): HasMany
    {
        return $this->hasMany(Special::class, 'special_category_id');
    }
}
