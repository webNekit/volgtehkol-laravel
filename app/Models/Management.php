<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Management extends Model
{
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'disciplines' => 'array',
    ];

    protected static function booted()
    {
        static::saving(function ($management) {
            if (!$management->order) {
                $management->order = static::max('order') + 1;
            } else if ($management->isDirty('order')) {
                $newOrder = $management->order;
                $oldOrder = $management->getOriginal('order');

                if ($oldOrder) {
                    if ($newOrder < $oldOrder) {
                        static::where('order', '>=', $newOrder)
                            ->where('order', '<', $oldOrder)
                            ->increment('order');
                    } else if ($newOrder > $oldOrder) {
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryManagement::class, 'category_management_id');
    }
}
