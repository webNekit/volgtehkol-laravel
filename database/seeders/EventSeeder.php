<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventFormat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'format' => 'Конференция',
                'title' => 'Студенческая научно-практическая конференция 2025',
                'description' => 'Мероприятие направлено на развитие научной активности студентов колледжа.',
                'content' => 'В рамках конференции студенты представляют результаты своих исследовательских работ по различным направлениям техники, IT и педагогики.',
                'start_date' => '2025-03-10',
                'end_date' => '2025-03-12',
                'direction' => 'Наука и образование',
                'organizer' => 'Методический отдел',
                'image' => 'events/conference_2025.jpg',
                'is_active' => true,
                'is_banner' => true,
                'is_slider' => true,
            ],
            [
                'format' => 'Олимпиада',
                'title' => 'Олимпиада по программированию среди студентов СПО',
                'description' => 'Соревнование для студентов в области алгоритмизации и написания кода.',
                'content' => 'Участники решают задачи различной сложности на языках C++, Python и JavaScript. Победители представят колледж на региональном этапе.',
                'start_date' => '2025-04-05',
                'end_date' => '2025-04-06',
                'direction' => 'Информационные технологии',
                'organizer' => 'Центр IT-образования',
                'image' => 'events/it_olymp.jpg',
                'is_active' => true,
                'is_banner' => false,
                'is_slider' => true,
            ],
            [
                'format' => 'Конкурс',
                'title' => 'Лучший по профессии — 2025',
                'description' => 'Ежегодный конкурс профессионального мастерства среди студентов технических специальностей.',
                'content' => 'В конкурс включены задания по сварочному делу, машиностроению, электронике и механике. Участники демонстрируют практические навыки.',
                'start_date' => '2025-05-20',
                'end_date' => '2025-05-21',
                'direction' => 'Профессиональное мастерство',
                'organizer' => 'Производственный отдел',
                'image' => 'events/best_student.jpg',
                'is_active' => true,
                'is_banner' => true,
                'is_slider' => false,
            ],
            [
                'format' => 'Мастер-класс',
                'title' => 'Современные технологии 3D-печати',
                'description' => 'Практическое занятие для студентов инженерных специальностей.',
                'content' => 'На мастер-классе демонстрируется работа современных 3D-принтеров и методики моделирования деталей.',
                'start_date' => '2025-02-15',
                'end_date' => '2025-02-15',
                'direction' => 'Инженерия и технологии',
                'organizer' => 'Кафедра мехатроники',
                'image' => 'events/3d_printing.jpg',
                'is_active' => true,
                'is_banner' => false,
                'is_slider' => false,
            ],
            [
                'format' => 'Семинар',
                'title' => 'Эффективное трудоустройство выпускников',
                'description' => 'Практический семинар с участием специалистов центра занятости.',
                'content' => 'На семинаре рассказывают о современных требованиях работодателей и способах составления резюме.',
                'start_date' => '2025-06-10',
                'end_date' => '2025-06-10',
                'direction' => 'Карьера и занятость',
                'organizer' => 'Центр карьеры ВТК',
                'image' => 'events/employment.jpg',
                'is_active' => true,
                'is_banner' => false,
                'is_slider' => false,
            ],
            [
                'format' => 'Форум',
                'title' => 'Молодёжный технический форум «Будущее Волгограда»',
                'description' => 'Крупное мероприятие, объединяющее студентов, преподавателей и представителей бизнеса.',
                'content' => 'Форум посвящён вопросам инновационного развития и цифровизации образования. Проходят дискуссии, выставки и презентации проектов.',
                'start_date' => '2025-09-15',
                'end_date' => '2025-09-17',
                'direction' => 'Инновации и цифровизация',
                'organizer' => 'Администрация колледжа',
                'image' => 'events/forum_future.jpg',
                'is_active' => true,
                'is_banner' => true,
                'is_slider' => true,
            ],
            [
                'format' => 'Фестиваль',
                'title' => 'Фестиваль студенческого творчества',
                'description' => 'Праздник талантов и креатива студентов ВТК.',
                'content' => 'Студенты демонстрируют свои таланты в музыке, танцах, театре и декоративно-прикладном искусстве.',
                'start_date' => '2025-03-28',
                'end_date' => '2025-03-29',
                'direction' => 'Творчество и культура',
                'organizer' => 'Студенческий совет',
                'image' => 'events/festival.jpg',
                'is_active' => true,
                'is_banner' => true,
                'is_slider' => false,
            ],
            [
                'format' => 'Тренинг',
                'title' => 'Навыки публичных выступлений',
                'description' => 'Интерактивный тренинг по развитию коммуникативных навыков.',
                'content' => 'Участники отрабатывают навыки уверенного общения и презентации своих идей перед аудиторией.',
                'start_date' => '2025-01-25',
                'end_date' => '2025-01-25',
                'direction' => 'Личностное развитие',
                'organizer' => 'Психологическая служба колледжа',
                'image' => 'events/public_speaking.jpg',
                'is_active' => true,
                'is_banner' => false,
                'is_slider' => false,
            ],
            [
                'format' => 'Выставка',
                'title' => 'Выставка технического творчества студентов',
                'description' => 'Лучшие студенческие проекты и изобретения.',
                'content' => 'На выставке представлены инженерные модели, макеты и программные решения студентов колледжа.',
                'start_date' => '2025-10-05',
                'end_date' => '2025-10-07',
                'direction' => 'Техническое творчество',
                'organizer' => 'Техническое отделение',
                'image' => 'events/tech_exhibition.jpg',
                'is_active' => true,
                'is_banner' => false,
                'is_slider' => true,
            ],
            [
                'format' => 'Встреча с работодателем',
                'title' => 'День карьеры в ВТК',
                'description' => 'Встреча студентов с представителями ведущих предприятий Волгограда.',
                'content' => 'Работодатели рассказывают о вакансиях, стажировках и возможностях трудоустройства после колледжа.',
                'start_date' => '2025-11-12',
                'end_date' => '2025-11-12',
                'direction' => 'Карьера и партнёрство',
                'organizer' => 'Центр содействия занятости студентов',
                'image' => 'events/career_day.jpg',
                'is_active' => true,
                'is_banner' => true,
                'is_slider' => true,
            ],
        ];

        foreach ($events as $data) {
            $format = EventFormat::where('title', $data['format'])->first();

            if ($format) {
                Event::create([
                    'event_format_id' => $format->id,
                    'title' => $data['title'],
                    'slug' => Str::slug($data['title']),
                    'description' => $data['description'],
                    'content' => $data['content'],
                    'start_date' => $data['start_date'],
                    'end_date' => $data['end_date'],
                    'direction' => $data['direction'],
                    'organizer' => $data['organizer'],
                    'image' => $data['image'],
                    'is_active' => $data['is_active'],
                    'is_banner' => $data['is_banner'],
                    'is_slider' => $data['is_slider'],
                ]);
            }
        }
    }
}
