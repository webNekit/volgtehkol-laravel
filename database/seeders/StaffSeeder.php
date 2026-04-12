<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryStaff;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $category = CategoryStaff::create([
            'title' => 'Руководство',
        ]);

        $staffList = [
            [
                'name' => 'Кантур Вячеслав Анатольевич',
                'position' => 'Директор',
                'phone' => '8(8442) 45-91-21',
                'email' => null,
                'disciplines' => null,
                'image' => '/upload/iblock/875/87568a0a8288415235bdb0e5120f6ae1.jpg',
            ],
            [
                'name' => 'Иваненко Наталья Анатольевна',
                'position' => 'Заместитель директора по учебно-методической работы',
                'phone' => '8(8442) 45-91-38',
                'email' => null,
                'disciplines' => json_encode(['Русский язык', 'Литература']),
                'image' => '/upload/iblock/feb/febe44cdf6045ca3aab7ed8145427e14.jpg',
            ],
            [
                'name' => 'Досов Адилжан Туткишевич',
                'position' => 'Руководитель Среднеахтубинского филиала ГБПОУ "Волгоградский технический колледж"',
                'phone' => '8(8442) 45-91-57',
                'email' => null,
                'disciplines' => null,
                'image' => '/upload/iblock/8ff/8ff7f94e57e41642b389f074f153646f.jpg',
            ],
            [
                'name' => 'Самарская Татьяна Олеговна',
                'position' => 'Заместитель директора по производственному обучению',
                'phone' => '8(8442) 45-91-48',
                'email' => null,
                'disciplines' => json_encode(['Правовое обеспечение в профессиональной деятельности']),
                'image' => '/upload/iblock/c21/c213a7902e882e03f215ae128281afa3.jpg',
            ],
            [
                'name' => 'Русских Александр Аркадьевич',
                'position' => 'Заведующий кафедрой «Автоматизация»',
                'phone' => null,
                'email' => null,
                'disciplines' => null,
                'image' => null,
            ],
            [
                'name' => 'Барякаев Александр Юрьевич',
                'position' => 'Заведующий кафедрой «Транспорт»',
                'phone' => null,
                'email' => null,
                'disciplines' => json_encode([
                    'МДК 02.02 Технология механизированных работ в растениеводстве',
                    'МДК 01.01 Назначение и общее устройство тракторов, автомобилей и сельхоз машин',
                    'МДК 02.03 Технология механизированных работ в животноводстве',
                    'МДК 05.01 Безопасность движения  и основы автотранспортного права'
                ]),
                'image' => '/upload/iblock/ec8/ec8128b032ee0cbe80694b863d64f393.jpg',
            ],
            [
                'name' => 'Цыбанева Наталья Александровна',
                'position' => 'Заведующий кафедрой "Финансы"',
                'phone' => null,
                'email' => null,
                'disciplines' => json_encode([
                    'Основы предпринимательской деятельности',
                    'Анализ ФХД',
                    'Основы экономики',
                    'Основы бухгалтерского учета',
                    'МДК 04.02 Основы анализа бухгалтерской отчетности'
                ]),
                'image' => '/upload/iblock/b1d/b1db3fada62e862aa44a1832b5b1958d.jpg',
            ],
            [
                'name' => 'Ефимова Алмагуль Кажимуратовна',
                'position' => 'Заведующий кафедрой «Землеустройство»',
                'phone' => null,
                'email' => null,
                'disciplines' => json_encode([
                    'Основы геологии',
                    'Топографическая графика',
                    'МДК 01.03 Фотограмметрические работы',
                    'МДК 02.02 Разработка и анализ проекта межхоз землеустройства',
                    'МДК 03.01 Земельные правоотношения'
                ]),
                'image' => '/upload/iblock/17e/17e7c824e9500f8c3bdede39edf80c5a.jpg',
            ],
            [
                'name' => 'Холодова Марина Юрьевна',
                'position' => 'Заместитель директора по финансам',
                'phone' => '8(8442) 45-91-04',
                'email' => null,
                'disciplines' => null,
                'image' => '/upload/iblock/057/0573aa6e141104c09b6738eeb3917a28.jpg',
            ],
            [
                'name' => 'Панкова Людмила Александровна',
                'position' => 'Начальник учебного отдела',
                'phone' => '+7 (8442) 41-67-39',
                'email' => null,
                'disciplines' => null,
                'image' => '/upload/iblock/a98/a98432ce2b9609086e7a3d207cdf8899.jpg',
            ],
            [
                'name' => 'Вахабова Асият Абдулмежидовна',
                'position' => 'Начальник воспитательного отдела',
                'phone' => '8 (8442) 41-67-39',
                'email' => 'a.a.vakhabova@volgtehkol.ru',
                'disciplines' => null,
                'image' => '/upload/iblock/eb2/eb238c78b31fa275ae907aeb31c06b73.jpg',
            ],
            [
                'name' => 'Петухова Галина Викторовна',
                'position' => 'Комендант общежития',
                'phone' => '8( 8442) 23-12-90',
                'email' => 'g.v.petuhova@volgtehkol.ru',
                'disciplines' => null,
                'image' => '/upload/iblock/189/18917b40ad9c8f1632cc521be6cff972.jpg',
            ],
        ];

        foreach ($staffList as $staff) {
            Staff::create(array_merge($staff, ['category_staff_id' => $category->id]));
        }
    }
}
