<?php

namespace App\Http\Controllers\Info;

use App\Http\Controllers\Controller;
use App\Models\ModulePage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InfoController extends Controller
{
    /**
     * Универсальный метод для рендера любой страницы модуля Info
     */

    protected function renderPage(string $pageKey)
    {
        $page = ModulePage::where('module', 'info')
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

        return view("info::{$bladeName}", [
            'title'   => $page->title,
            'content' => $page->content,
            'images'  => $page->images,
            'files'   => $page->files,
            'links'   => $page->links,
        ]);
    }

    // Методы страниц
    public function basics()       { return $this->renderPage('basics'); }
    public function structure()    { return $this->renderPage('structure'); }
    public function mtResources()  { return $this->renderPage('mtResources'); }
    public function paidServices() { return $this->renderPage('paidServices'); }
    public function finance()      { return $this->renderPage('finance'); }
    public function vacancies()    { return $this->renderPage('vacancies'); }
    public function scholarships() { return $this->renderPage('scholarships'); }
    public function catering()     { return $this->renderPage('catering'); }
    public function standards()    { return $this->renderPage('standards'); }
}
