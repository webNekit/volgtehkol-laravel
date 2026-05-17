<?php

namespace App\Http\Controllers\College;

use App\Http\Controllers\Controller;
use App\Models\ModulePage;
use Illuminate\Support\Str;

class CollegeController extends Controller
{
    protected function renderPage(string $pageKey)
    {
        $page = ModulePage::with(['imageAttachments', 'fileAttachments', 'relatedLinks'])
            ->where('module', 'college')
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

        return view("college::{$bladeName}", [
            'title' => $page->title,
            'content' => $page->content,
            'images' => $page->images,
            'files' => $page->files,
            'links' => $page->links,
        ]);
    }

    public function basics()
    {
        return $this->renderPage('basics');
    }
    public function structure()
    {
        return $this->renderPage('structure');
    }
    public function history()
    {
        return $this->renderPage('history');
    }
    public function charter()
    {
        return $this->renderPage('charter');
    }
    public function vacancies()
    {
        return $this->renderPage('vacancies');
    }
    public function virtualTour()
    {
        return $this->renderPage('virtualTour');
    }

    public function education()
    {
        return $this->renderPage('education');
    }


    public function ed()
    {
        return $this->renderPage('ed');
    }

}
