<?php

namespace App\Http\Controllers\College;

use App\Http\Controllers\Controller;
use App\Models\ModulePage;
use Illuminate\Support\Str;

class CollegeController extends Controller
{
    protected function renderPage(string $pageKey)
    {
        $page = ModulePage::where('module', 'college')
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

        return view("college::{$bladeName}", [
            'title'   => $page->title,
            'content' => $page->content,
            'images'  => $page->images,
            'files'   => $page->files,
            'links'   => $page->links,
        ]);
    }

    public function basics()      { return $this->renderPage('basics'); }
    public function structure()   { return $this->renderPage('structure'); }
    public function history()     { return $this->renderPage('history'); }
    public function charter()     { return $this->renderPage('charter'); }
    public function vacancies()   { return $this->renderPage('vacancies'); }
    public function virtualTour() { return $this->renderPage('virtualTour'); }
}
