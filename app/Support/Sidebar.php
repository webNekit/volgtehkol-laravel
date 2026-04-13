<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;

class Sidebar
{
    protected static array $routes = [     'news::index',
        'docs::index',
        'staff::index',
        'management::index',
        'specials::index',
        'contacts::index',

        'info::basics',
        'info::structure',
        'info::mtResources',
        'info::education',
        'info::paidServices',
        'info::finance',
        'info::vacancies',
        'info::scholarships',
        'info::catering',
        'info::standards',
        // 'info::accessibleEnvironment',
        'info::internationalCooperation',
        'info::sredneahtubinskBranch',

        'college::basics',
        'college::structure',
        'college::history',
        'college::charter',
        'college::vacancies',
        'college::virtualTour',
        'college::specials',
        'staff::index',
        'management::index',
        'college::news',
        'college::contacts',

        'abiturients::admissionCommittee',
        'abiturients::admissionRules',
        'abiturients::specialties',
        'abiturients::paidEducation',
        'abiturients::dormitory',
        'abiturients::medicalExams',
        'abiturients::applicationInfo',
        'abiturients::documents',
        'abiturients::faq',
        'abiturients::examSchedule',
        'abiturients::examResults',
        'abiturients::enrollmentOrder',
        'abiturients::recommendedList',

        'students::internalRules',
        'students::examInfo',
        'students::safety',
        'students::extremism',
        'students::corruption',
        'students::employment',
        'students::vacancies',
        'students::schedule',

        'additional_education::documents',
        'additional_education::qualificationPrograms',
        'additional_education::professionalPrograms',
        'additional_education::childrenAndAdults',
        'additional_education::covidTraining',
        'additional_education::announcements',
    ];

    public static function showRoutes()
    {

        // ---------------------------------
        // 1. Показывать sidebar на /common/*
        // ---------------------------------
        if (request()->is('common/*')) {
            return true;
        }

        // ---------------------------------
        // 2. Старая логика — по статическим роутам
        // ---------------------------------
        foreach (self::$routes as $route) {
            if (Route::is($route)) {
                return true;
            }
        }

        return false;
    }
}
