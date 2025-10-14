<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Новости колледжа',
            'Абитуриенту',
            'Студенту',
            'Дополнительное образование',
            'Государственная итоговая аттестация',
            'Партнёры и работодатели',
            'Наука и инновации',
        ];

        foreach ($categories as $title) {
            Category::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'is_active' => true,
            ]);
        }
    }
}
