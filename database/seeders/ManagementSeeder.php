<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryManagement;
use App\Models\Management;

class ManagementSeeder extends Seeder
{
    public function run(): void
    {
        $category = CategoryManagement::create([
            'title' => 'Руководство',
        ]);

        $managementList = [
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
                'disciplines' => null,
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
                'disciplines' => null,
                'image' => '/upload/iblock/c21/c213a7902e882e03f215ae128281afa3.jpg',
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

        foreach ($managementList as $management) {
            Management::create(array_merge($management, ['category_management_id' => $category->id]));
        }
    }
}
