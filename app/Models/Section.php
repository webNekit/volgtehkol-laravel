<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'status',
    ];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
