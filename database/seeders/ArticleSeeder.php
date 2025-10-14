<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'category' => 'Новости колледжа',
                'title' => 'Открытие нового учебного корпуса',
                'description' => 'Торжественное открытие нового учебного корпуса по адресу ул. Рабоче-Крестьянская, 10.',
                'content' => 'Сегодня состоялось торжественное открытие нового учебного корпуса Волгоградского технического колледжа. В мероприятии приняли участие представители администрации города, преподаватели и студенты.',
                'image' => 'articles/corpus_opening.jpg',
                'is_active' => true,
                'is_banner' => true,
                'is_slider' => true,
            ],
            [
                'category' => 'Абитуриенту',
                'title' => 'Приёмная кампания 2025 года',
                'description' => 'Стартует приём документов на обучение в 2025 году. Ознакомьтесь с направлениями подготовки.',
                'content' => 'В этом году колледж предлагает широкий выбор программ среднего профессионального образования. Подать документы можно онлайн или лично в приёмной комиссии.',
                'image' => 'articles/admission_2025.jpg',
                'is_active' => true,
                'is_banner' => false,
                'is_slider' => true,
            ],
            [
                'category' => 'Студенту',
                'title' => 'Расписание занятий на осенний семестр',
                'description' => 'Опубликовано актуальное расписание занятий для всех отделений.',
                'content' => 'Расписание доступно на сайте колледжа в разделе "Студенту" и обновляется каждую неделю.',
                'image' => 'articles/schedule_autumn.jpg',
                'is_active' => true,
                'is_banner' => false,
                'is_slider' => false,
            ],
            [
                'category' => 'Дополнительное образование',
                'title' => 'Курсы повышения квалификации по 3D-моделированию',
                'description' => 'Открыт набор на курсы 3D-моделирования для специалистов и студентов.',
                'content' => 'Занятия проходят в компьютерных аудиториях колледжа, оснащённых современным ПО. По завершении курса выдаётся сертификат.',
                'image' => 'articles/3d_course.jpg',
                'is_active' => true,
                'is_banner' => false,
                'is_slider' => false,
            ],
            [
                'category' => 'Государственная итоговая аттестация',
                'title' => 'Подготовка к ГИА 2025',
                'description' => 'Рекомендации и материалы для подготовки студентов к итоговой аттестации.',
                'content' => 'На сайте размещены методические рекомендации и примеры заданий для подготовки к ГИА. Студентам рекомендуется ознакомиться заранее.',
                'image' => 'articles/gia_2025.jpg',
                'is_active' => true,
                'is_banner' => false,
                'is_slider' => false,
            ],
            [
                'category' => 'Партнёры и работодатели',
                'title' => 'Сотрудничество с Волжским тракторным заводом',
                'description' => 'Колледж заключил соглашение о практическом обучении студентов на базе предприятия.',
                'content' => 'Данное соглашение позволит студентам проходить производственную практику и стажировку на реальном производстве.',
                'image' => 'articles/volzhsky_plant.jpg',
                'is_active' => true,
                'is_banner' => true,
                'is_slider' => false,
            ],
        ];

        foreach ($articles as $data) {
            $category = Category::where('title', $data['category'])->first();

            if ($category) {
                Article::create([
                    'category_id' => $category->id,
                    'title' => $data['title'],
                    'slug' => Str::slug($data['title']),
                    'description' => $data['description'],
                    'content' => $data['content'],
                    'image' => $data['image'],
                    'is_active' => $data['is_active'],
                    'is_banner' => $data['is_banner'],
                    'is_slider' => $data['is_slider'],
                ]);
            }
        }
    }
}
