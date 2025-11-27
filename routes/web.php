<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Home')->as('home::')->group(function () {
    Route::get('/', [\App\Http\Controllers\Home\HomeController::class, 'index'])->name('index');
});

Route::prefix('common')->group(function () {
    Route::namespace('Common')->as('common::')->group(function () {
        Route::get('{slug}', [\App\Http\Controllers\Common\CommonController::class, 'show'])->name('show');
    });
});

Route::prefix('info')->group(function () {
    Route::namespace('Info')->as('info::')->group(function () {
       Route::get('/basics', [\App\Http\Controllers\Info\InfoController::class, 'basics'])->name('basics');
        Route::get('/structure', [\App\Http\Controllers\Info\InfoController::class, 'structure'])->name('structure');
        Route::get('/mt-resources', [\App\Http\Controllers\Info\InfoController::class, 'mtResources'])->name('mtResources');
        Route::get('/paid-services', [\App\Http\Controllers\Info\InfoController::class, 'paidServices'])->name('paidServices');
        Route::get('/finance', [\App\Http\Controllers\Info\InfoController::class, 'finance'])->name('finance');
        Route::get('/vacancies', [\App\Http\Controllers\Info\InfoController::class, 'vacancies'])->name('vacancies');
        Route::get('/scholarships', [\App\Http\Controllers\Info\InfoController::class, 'scholarships'])->name('scholarships');
        Route::get('/catering', [\App\Http\Controllers\Info\InfoController::class, 'catering'])->name('catering');
        Route::get('/standards', [\App\Http\Controllers\Info\InfoController::class, 'standards'])->name('standards');
    });
    Route::namespace('Docs')->as('docs::')->group(function () {
        Route::get('/documents', [\App\Http\Controllers\Docs\DocsController::class, 'index'])->name('index');
    });
});

Route::prefix('college')->group(function () {
    Route::namespace('College')->as('college::')->group(function () {
        Route::get('/basics', [\App\Http\Controllers\College\CollegeController::class, 'basics'])->name('basics');
        Route::get('/structure', [\App\Http\Controllers\College\CollegeController::class, 'structure'])->name('structure');
        Route::get('/history', [\App\Http\Controllers\College\CollegeController::class, 'history'])->name('history');
        Route::get('/charter', [\App\Http\Controllers\College\CollegeController::class, 'charter'])->name('charter');
        Route::get('/vacancies', [\App\Http\Controllers\College\CollegeController::class, 'vacancies'])->name('vacancies');
        Route::get('/virtual-tour', [\App\Http\Controllers\College\CollegeController::class, 'virtualTour'])->name('virtualTour');
        Route::get('/specialties', [\App\Http\Controllers\Specials\SpecialsController::class, 'index'])->name('specials'); // уже есть Specials
        Route::get('/management', [\App\Http\Controllers\Staff\StaffController::class, 'index'])->name('management'); // Руководство и педагогический состав
        Route::get('/news', [\App\Http\Controllers\News\NewsController::class, 'index'])->name('news'); // Новости
        Route::get('/contacts', [\App\Http\Controllers\Contact\ContactController::class, 'index'])->name('contacts'); // Контакты
    });
    Route::namespace('Specials')->as('specials::')->group(function () {
        Route::get('/specials', [\App\Http\Controllers\Specials\SpecialsController::class, 'index'])->name('index');
        Route::get('/specials/{id}/show', [\App\Http\Controllers\Specials\SpecialsController::class, 'show'])->name('show');
    });
    Route::namespace('Staff')->as('staff::')->group(function () {
        Route::get('/employees', [\App\Http\Controllers\Staff\StaffController::class, 'index'])->name('index');
    });
    Route::namespace('Events')->as('events::')->group(function () {
        Route::get('/events/{id}/show', [\App\Http\Controllers\Events\EventsController::class, 'show'])->name('show');
    });
    Route::namespace('News')->as('news::')->group(function () {
        Route::get('/news', [\App\Http\Controllers\News\NewsController::class, 'index'])->name('index');
        Route::get('/news/{slug}/show', [\App\Http\Controllers\News\NewsController::class, 'show'])->name('show');
    });
    Route::namespace('Contact')->as('contacts::')->group(function () {
        Route::get('/contacts', [\App\Http\Controllers\Contact\ContactController::class, 'index'])->name('index');
    });
});

Route::prefix('abiturients')->group(function () {
    Route::namespace('Abiturients')->as('abiturients::')->group(function () {
        Route::get('/admission-committee', [\App\Http\Controllers\Abiturients\AbiturientsController::class, 'admissionCommittee'])->name('admissionCommittee');
        Route::get('/admission-rules', [\App\Http\Controllers\Abiturients\AbiturientsController::class, 'admissionRules'])->name('admissionRules');
        Route::get('/specialties', [\App\Http\Controllers\Abiturients\AbiturientsController::class, 'specialties'])->name('specialties');
        Route::get('/paid-education', [\App\Http\Controllers\Abiturients\AbiturientsController::class, 'paidEducation'])->name('paidEducation');
        Route::get('/dormitory', [\App\Http\Controllers\Abiturients\AbiturientsController::class, 'dormitory'])->name('dormitory');
        Route::get('/medical-exams', [\App\Http\Controllers\Abiturients\AbiturientsController::class, 'medicalExams'])->name('medicalExams');
        Route::get('/application-info', [\App\Http\Controllers\Abiturients\AbiturientsController::class, 'applicationInfo'])->name('applicationInfo');
        Route::get('/documents', [\App\Http\Controllers\Abiturients\AbiturientsController::class, 'documents'])->name('documents');
        Route::get('/faq', [\App\Http\Controllers\Abiturients\AbiturientsController::class, 'faq'])->name('faq');
        Route::get('/exam-schedule', [\App\Http\Controllers\Abiturients\AbiturientsController::class, 'examSchedule'])->name('examSchedule');
        Route::get('/exam-results', [\App\Http\Controllers\Abiturients\AbiturientsController::class, 'examResults'])->name('examResults');
        Route::get('/enrollment-order', [\App\Http\Controllers\Abiturients\AbiturientsController::class, 'enrollmentOrder'])->name('enrollmentOrder');
        Route::get('/recommended-list', [\App\Http\Controllers\Abiturients\AbiturientsController::class, 'recommendedList'])->name('recommendedList');
    });
});

Route::prefix('students')->group(function () {
    Route::namespace('Students')->as('students::')->group(function () {
        Route::get('/internal-rules', [\App\Http\Controllers\Students\StudentsController::class, 'internalRules'])->name('internalRules');
        Route::get('/exam-info', [\App\Http\Controllers\Students\StudentsController::class, 'examInfo'])->name('examInfo');
        Route::get('/safety', [\App\Http\Controllers\Students\StudentsController::class, 'safety'])->name('safety');
        Route::get('/extremism', [\App\Http\Controllers\Students\StudentsController::class, 'extremism'])->name('extremism');
        Route::get('/corruption', [\App\Http\Controllers\Students\StudentsController::class, 'corruption'])->name('corruption');
        Route::get('/employment', [\App\Http\Controllers\Students\StudentsController::class, 'employment'])->name('employment');
        Route::get('/vacancies', [\App\Http\Controllers\Students\StudentsController::class, 'vacancies'])->name('vacancies');
        Route::get('/schedule', [\App\Http\Controllers\Students\StudentsController::class, 'schedule'])->name('schedule');
    });
});

Route::prefix('additional_education')->group(function () {
    Route::namespace('AdditionalEducation')->as('additional_education::')->group(function () {
        Route::get('/documents', [\App\Http\Controllers\AdditionalEducation\AdditionalEducationController::class, 'documents'])->name('documents');
        Route::get('/qualification-programs', [\App\Http\Controllers\AdditionalEducation\AdditionalEducationController::class, 'qualificationPrograms'])->name('qualificationPrograms');
        Route::get('/professional-programs', [\App\Http\Controllers\AdditionalEducation\AdditionalEducationController::class, 'professionalPrograms'])->name('professionalPrograms');
        Route::get('/children-and-adults', [\App\Http\Controllers\AdditionalEducation\AdditionalEducationController::class, 'childrenAndAdults'])->name('childrenAndAdults');
        Route::get('/covid-training', [\App\Http\Controllers\AdditionalEducation\AdditionalEducationController::class, 'covidTraining'])->name('covidTraining');
        Route::get('/announcements', [\App\Http\Controllers\AdditionalEducation\AdditionalEducationController::class, 'announcements'])->name('announcements');
    });
});
