<?php

namespace App\Http\Controllers\AdditionalEducation;

use App\Http\Controllers\Controller;
use App\Models\ModulePage;
use Illuminate\Support\Str;

class AdditionalEducationController extends Controller
{
    protected function renderPage(string $pageKey)
    {
        $page = ModulePage::with(['imageAttachments', 'fileAttachments', 'relatedLinks'])
            ->where('module', 'additional_education')
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

        return view("additional_education::{$bladeName}", [
            'title' => $page->title,
            'content' => $page->content,
            'images' => $page->images,
            'files' => $page->files,
            'links' => $page->links,
        ]);
    }

    public function documents()
    {
        return $this->renderPage('documents');
    }
    public function qualificationPrograms()
    {
        return $this->renderPage('qualificationPrograms');
    }
    public function professionalPrograms()
    {
        return $this->renderPage('professionalPrograms');
    }
    public function childrenAndAdults()
    {
        return $this->renderPage('childrenAndAdults');
    }
    public function covidTraining()
    {
        return $this->renderPage('covidTraining');
    }
    public function announcements()
    {
        return $this->renderPage('announcements');
    }
}
