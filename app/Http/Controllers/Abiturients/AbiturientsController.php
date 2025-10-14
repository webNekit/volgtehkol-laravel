<?php

namespace App\Http\Controllers\Abiturients;

use App\Http\Controllers\Controller;
use App\Models\ModulePage;
use Illuminate\Support\Str;

class AbiturientsController extends Controller
{
    protected function renderPage(string $pageKey)
    {
        $page = ModulePage::where('module', 'abiturients')
            ->where('page_key', $pageKey)
            ->first(); // убрали firstOrFail()

        // Если страница не найдена, создаем заглушку
        if (!$page) {
            $page = (object)[
                'title'   => 'Страница редактируется',
                'content' => '<p>Информация пока недоступна.</p>',
                'images'  => [],
                'files'   => [],
                'links'   => [],
            ];
        } else {
            // Декодируем JSON поля только если страница есть
            $page->images = is_string($page->images) ? json_decode($page->images, true) : ($page->images ?? []);
            $page->files  = is_string($page->files)  ? json_decode($page->files, true)  : ($page->files ?? []);
            $page->links  = is_string($page->links)  ? json_decode($page->links, true)  : ($page->links ?? []);
        }

        $bladeName = Str::kebab($pageKey);

        return view("abiturients::{$bladeName}", [
            'title'   => $page->title,
            'content' => $page->content,
            'images'  => $page->images,
            'files'   => $page->files,
            'links'   => $page->links,
        ]);
    }

    public function admissionCommittee()   { return $this->renderPage('admissionCommittee'); }
    public function admissionRules()       { return $this->renderPage('admissionRules'); }
    public function specialties()          { return $this->renderPage('specialties'); }
    public function paidEducation()        { return $this->renderPage('paidEducation'); }
    public function dormitory()            { return $this->renderPage('dormitory'); }
    public function medicalExams()         { return $this->renderPage('medicalExams'); }
    public function applicationInfo()      { return $this->renderPage('applicationInfo'); }
    public function documents()            { return $this->renderPage('documents'); }
    public function faq()                  { return $this->renderPage('faq'); }
    public function examSchedule()         { return $this->renderPage('examSchedule'); }
    public function examResults()          { return $this->renderPage('examResults'); }
    public function enrollmentOrder()      { return $this->renderPage('enrollmentOrder'); }
    public function recommendedList()      { return $this->renderPage('recommendedList'); }
}
