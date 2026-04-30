<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Staff extends Model
{
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'disciplines' => 'array',
        'education' => 'array',
        'work_experience' => 'array',
        'professional_development' => 'array',
        'honors' => 'array',
    ];

    protected static function booted()
    {
        static::saving(function ($staff) {
            if (!$staff->order) {
                $staff->order = static::max('order') + 1;
            } else if ($staff->isDirty('order')) {
                $newOrder = $staff->order;
                $oldOrder = $staff->getOriginal('order');

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
        return $this->belongsTo(CategoryStaff::class, 'category_staff_id');
    }
}
