<?php

namespace App\Http\Controllers\Abiturients;

use App\Http\Controllers\Controller;
use App\Models\ModulePage;
use Illuminate\Support\Str;

class AbiturientsController extends Controller
{
    protected function renderPage(string $pageKey)
    {
        $page = ModulePage::with(['imageAttachments', 'fileAttachments', 'relatedLinks'])
            ->where('module', 'abiturients')
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

        return view("abiturients::{$bladeName}", [
            'title' => $page->title,
            'content' => $page->content,
            'images' => $page->images,
            'files' => $page->files,
            'links' => $page->links,
        ]);
    }

    public function admissionCommittee()
    {
        return $this->renderPage('admissionCommittee');
    }
    public function admissionRules()
    {
        return $this->renderPage('admissionRules');
    }
    public function specialties()
    {
        return $this->renderPage('specialties');
    }
    public function paidEducation()
    {
        return $this->renderPage('paidEducation');
    }
    public function dormitory()
    {
        return $this->renderPage('dormitory');
    }
    public function medicalExams()
    {
        return $this->renderPage('medicalExams');
    }
    public function applicationInfo()
    {
        return $this->renderPage('applicationInfo');
    }
    public function documents()
    {
        return $this->renderPage('documents');
    }
    public function faq()
    {
        return $this->renderPage('faq');
    }
    public function examSchedule()
    {
        return $this->renderPage('examSchedule');
    }
    public function examResults()
    {
        return $this->renderPage('examResults');
    }
    public function enrollmentOrder()
    {
        return $this->renderPage('enrollmentOrder');
    }
    public function recommendedList()
    {
        return $this->renderPage('recommendedList');
    }
}
