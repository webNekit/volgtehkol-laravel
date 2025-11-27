<?php

namespace App\Enums;

enum NavigationGroup: string {
    case Content = "Новости";
    case Event = "Мероприятия";
    case MainModules = 'Основные модули';
    case EducationInfo = "Коллекции";
    case OptionalPage = "Опциональные страницы";
}
