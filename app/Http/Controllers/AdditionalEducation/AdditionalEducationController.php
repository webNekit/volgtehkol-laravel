<?php

namespace App\Http\Controllers\AdditionalEducation;

use App\Http\Controllers\Controller;
use App\Models\ModulePage;
use Illuminate\Support\Str;

class AdditionalEducationController extends Controller
{
    protected function renderPage(string $pageKey)
    {
        $page = ModulePage::where('module', 'additional_education')
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

        return view("additional_education::{$bladeName}", [
            'title'   => $page->title,
            'content' => $page->content,
            'images'  => $page->images,
            'files'   => $page->files,
            'links'   => $page->links,
        ]);
    }

    public function documents()             { return $this->renderPage('documents'); }
    public function qualificationPrograms() { return $this->renderPage('qualificationPrograms'); }
    public function professionalPrograms()  { return $this->renderPage('professionalPrograms'); }
    public function childrenAndAdults()     { return $this->renderPage('childrenAndAdults'); }
    public function covidTraining()         { return $this->renderPage('covidTraining'); }
    public function announcements()         { return $this->renderPage('announcements'); }
}
