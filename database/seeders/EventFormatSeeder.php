<?php

namespace Database\Seeders;

use App\Models\EventFormat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventFormatSeeder extends Seeder
{
    public function run(): void
    {
        $formats = [
            'Конференция',
            'Олимпиада',
            'Конкурс',
            'Мастер-класс',
            'Семинар',
            'Выставка',
            'Форум',
            'Фестиваль',
            'Тренинг',
            'Встреча с работодателем',
        ];

        foreach ($formats as $title) {
            EventFormat::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'is_active' => true,
            ]);
        }
    }
}
