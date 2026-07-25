<?php

namespace Database\Seeders;

use App\Enums\EducationLevel;
use App\Models\SpecialCategory;
use Illuminate\Database\Seeder;

class SpecialCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Технические специальности',
            'Информационные технологии',
            'Экономика и управление',
            'Сельское хозяйство и экология',
            'Сфера обслуживания и безопасность',
        ];

        foreach ($categories as $title) {
            SpecialCategory::create([
                'title' => $title,
                'education_level' => EducationLevel::Spo,
                'is_active' => true,
            ]);
        }
    }
}
