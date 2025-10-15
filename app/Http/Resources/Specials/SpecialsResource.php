<?php

namespace App\Http\Resources\Specials;

use App\Models\Special;
use App\Models\SpecialCategory;

class SpecialsResource
{
    public static function index()
    {
        return Special::query()->where('is_active', true)->orderBy('created_at', 'desc')->get();
    }

    public static function collection()
    {
        return SpecialCategory::with(['specials' => function ($query) {
            $query->where('is_active', true)
                ->orderBy('id', 'desc');
        }])
            ->where('is_active', true)
            ->orderBy('title')
            ->get();
    }

    public static function findOrFail($id)
    {
        return Special::where('id', $id)->firstOrFail();
    }
}

