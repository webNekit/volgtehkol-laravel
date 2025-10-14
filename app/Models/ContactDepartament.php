<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactDepartament extends Model
{
    protected $guarded = [];
    protected $casts = ['is_active' => 'boolean'];

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class, 'contact_departament_id');
    }
}
