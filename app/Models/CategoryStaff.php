<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryStaff extends Model
{
    protected $guarded = [];

    public function staff(): HasMany
    {
        return $this->hasMany(Staff::class, 'category_staff_id');
    }
}
