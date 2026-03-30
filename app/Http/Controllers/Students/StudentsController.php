<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\ModulePage;
use Illuminate\Support\Str;

class StudentsController extends Controller
{
    protected function renderPage(string $pageKey)
    {
        $page = ModulePage::with(['imageAttachments', 'fileAttachments', 'relatedLinks'])
            ->where('module', 'students')
            ->where('page_key', $pageKey)
            ->first();

        // Если страница не найдена, создаем заглушку
        if (!$page) {
            $page = (object) [
                'title' => 'Страница редактируется',
                'content' => '<p>Информация пока недоступна.</p>',
                'images' => collect([]),
                'files' => collect([]),
                'links' => collect([]),
            ];
        } else {
            $page->images = $page->imageAttachments;
            $page->files = $page->fileAttachments;
            $page->links = $page->relatedLinks;
        }

        $bladeName = Str::kebab($pageKey);

        return view("students::{$bladeName}", [
            'title' => $page->title,
            'content' => $page->content,
            'images' => $page->images,
            'files' => $page->files,
            'links' => $page->links,
        ]);
    }

    public function internalRules()
    {
        return $this->renderPage('internalRules');
    }
    public function examInfo()
    {
        return $this->renderPage('examInfo');
    }
    public function safety()
    {
        return $this->renderPage('safety');
    }
    public function extremism()
    {
        return $this->renderPage('extremism');
    }
    public function corruption()
    {
        return $this->renderPage('corruption');
    }
    public function employment()
    {
        return $this->renderPage('employment');
    }
    public function vacancies()
    {
        return $this->renderPage('vacancies');
    }
    public function schedule()
    {
        return $this->renderPage('schedule');
    }
}
