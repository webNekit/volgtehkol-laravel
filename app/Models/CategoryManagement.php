<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryManagement extends Model
{
    protected $guarded = [];

    public function management(): HasMany
    {
        return $this->hasMany(Management::class, 'category_management_id');
    }
}
