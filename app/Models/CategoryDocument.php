<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryDocument extends Model
{
    protected $guarded = [];
    protected $casts = ['is_active' => 'boolean'];

    protected static function booted()
    {
        static::saving(function ($category) {
            if (!$category->order) {
                $category->order = static::max('order') + 1;
            }
            else if ($category->isDirty('order')) {
                $newOrder = $category->order;
                $oldOrder = $category->getOriginal('order');

                if ($oldOrder) {
                    if ($newOrder < $oldOrder) {
                        static::where('order', '>=', $newOrder)
                            ->where('order', '<', $oldOrder)
                            ->increment('order');
                    }
                    else if ($newOrder > $oldOrder) {
                        static::where('order', '>', $oldOrder)
                            ->where('order', '<=', $newOrder)
                            ->decrement('order');
                    }
                } else {
                    static::where('order', '>=', $newOrder)->increment('order');
                }
            }
        });
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'category_document_id');
    }
}
