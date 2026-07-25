<?php

namespace App\Models;

use App\Enums\EducationLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpecialCategory extends Model
{
    protected $guarded = [];
    protected $casts = [
        'is_active' => 'boolean',
        'education_level' => EducationLevel::class,
    ];

    public function specials(): HasMany
    {
        return $this->hasMany(Special::class, 'special_category_id');
    }
}
