<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;
use phpDocumentor\Reflection\Types\True_;

class Sidebar {
    protected static array $routes = [
        'news::index',
        'docs::index',
        'staff::index',
        'specials::index',
        'contacts::index',

        'info::basics',
        'info::structure',
        'info::mtResources',
        'info::paidServices',
        'info::finance',
        'info::vacancies',
        'info::scholarships',
        'info::catering',
        'info::standards',

        'college::basics',
        'college::structure',
        'college::history',
        'college::charter',
        'college::vacancies',
        'college::virtualTour',
        'college::specials',
        'college::management',
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

    public static function showRoutes() {
        foreach (self::$routes as $route) {
            if (Route::is($route)) {
                return true;
            }
        }
        return false;
    }
}
