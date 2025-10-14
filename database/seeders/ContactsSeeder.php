<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactDepartament;
use App\Models\Contact;

class ContactsSeeder extends Seeder
{
    public function run(): void
    {
        // Создаём департаменты
        $departmentsIds = [];

        $departments = [
            'Общие контакты',
            'Приёмная комиссия',
            'Бухгалтерия',
            'Отдел правового, кадрового и документационного обеспечения',
            'Общежитие №1',
            'Общежитие №2',
            'Учебно-производственный технопарк',
        ];

        foreach ($departments as $title) {
            $departmentsIds[$title] = ContactDepartament::create([
                'title' => $title,
                'is_active' => true,
            ])->id;
        }

        // Создаём контакты
        $contacts = [
            // Общие контакты
            [
                'contact_departament_id' => $departmentsIds['Общие контакты'],
                'title' => 'Главный телефон',
                'type' => 'phone',
                'value' => '88005553255',
                'is_header' => true,
                'is_footer' => true,
                'is_active' => true,
            ],
            [
                'contact_departament_id' => $departmentsIds['Общие контакты'],
                'title' => 'E-mail',
                'type' => 'email',
                'value' => 'volgtehkol@volganet.ru',
                'is_header' => true,
                'is_footer' => true,
                'is_active' => true,
            ],

            // Приёмная комиссия
            [
                'contact_departament_id' => $departmentsIds['Приёмная комиссия'],
                'title' => 'Телефон приёмной комиссии',
                'type' => 'phone',
                'value' => '88442459138',
                'is_header' => false,
                'is_footer' => true,
                'is_active' => true,
            ],

            // Бухгалтерия
            [
                'contact_departament_id' => $departmentsIds['Бухгалтерия'],
                'title' => 'Телефон бухгалтерии',
                'type' => 'phone',
                'value' => '88442459104',
                'is_header' => false,
                'is_footer' => true,
                'is_active' => true,
            ],

            // Отдел правового и кадрового обеспечения
            [
                'contact_departament_id' => $departmentsIds['Отдел правового, кадрового и документационного обеспечения'],
                'title' => 'Телефон отдела',
                'type' => 'phone',
                'value' => '88442735085',
                'is_header' => false,
                'is_footer' => true,
                'is_active' => true,
            ],

            // Общежития
            [
                'contact_departament_id' => $departmentsIds['Общежитие №1'],
                'title' => 'Общежитие 18',
                'type' => 'phone',
                'value' => '88442231290',
                'is_header' => false,
                'is_footer' => true,
                'is_active' => true,
            ],
            [
                'contact_departament_id' => $departmentsIds['Общежитие №2'],
                'title' => 'Общежитие 15',
                'type' => 'phone',
                'value' => '88442741360',
                'is_header' => false,
                'is_footer' => true,
                'is_active' => true,
            ],

            // Учебно-производственный технопарк
            [
                'contact_departament_id' => $departmentsIds['Учебно-производственный технопарк'],
                'title' => 'Телефон технопарка',
                'type' => 'phone',
                'value' => '88442613620',
                'is_header' => false,
                'is_footer' => true,
                'is_active' => true,
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
