<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\ModulePage;
use Illuminate\Support\Str;

class StudentsController extends Controller
{
    protected function renderPage(string $pageKey)
    {
        $page = ModulePage::where('module', 'students')
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

        return view("students::{$bladeName}", [
            'title'   => $page->title,
            'content' => $page->content,
            'images'  => $page->images,
            'files'   => $page->files,
            'links'   => $page->links,
        ]);
    }

    public function internalRules() { return $this->renderPage('internalRules'); }
    public function examInfo()      { return $this->renderPage('examInfo'); }
    public function safety()        { return $this->renderPage('safety'); }
    public function extremism()     { return $this->renderPage('extremism'); }
    public function corruption()    { return $this->renderPage('corruption'); }
    public function employment()    { return $this->renderPage('employment'); }
    public function vacancies()     { return $this->renderPage('vacancies'); }
    public function schedule()      { return $this->renderPage('schedule'); }
}
