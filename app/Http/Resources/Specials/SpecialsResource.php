<?php

namespace App\Http\Resources\Specials;

use App\Enums\EducationLevel;
use App\Models\Special;
use App\Models\SpecialCategory;

class SpecialsResource
{
    public static function index()
    {
        return Special::query()->where('is_active', true)->orderBy('code', 'asc')->get();
    }

    public static function collection()
    {
        return SpecialCategory::with(['specials' => function ($query) {
            $query->where('is_active', true)
                ->orderBy('id', 'desc');
        }])
            ->where('is_active', true)
            ->orderBy('id')
            ->get();
    }

    /**
     * Специальности, сгруппированные по уровню образования.
     * Порядок разделов задаёт EducationLevel: сначала СПО, затем остальные активные.
     *
     * @return array<int, array{level: string, title: string, specials: array}>
     */
    public static function grouped($categoryId = null): array
    {
        return self::collection()
            ->when($categoryId, fn($categories) => $categories->where('id', (int) $categoryId))
            ->filter(fn(SpecialCategory $category) => $category->specials->isNotEmpty())
            ->groupBy(fn(SpecialCategory $category) => ($category->education_level ?? EducationLevel::Spo)->value)
            ->sortBy(fn($group, $level) => EducationLevel::from($level)->sort())
            ->map(fn($group, $level) => [
                'level' => $level,
                'title' => EducationLevel::from($level)->label(),
                'specials' => $group->pluck('specials')
                    ->flatten()
                    ->sortBy('code')
                    ->map(fn(Special $special) => [
                        'id' => $special->id,
                        'code' => $special->code,
                        'title' => $special->title,
                    ])->values()->toArray(),
            ])
            ->values()
            ->toArray();
    }

    public static function findOrFail($id)
    {
        return Special::where('id', $id)->firstOrFail();
    }
}

