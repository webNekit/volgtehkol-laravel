<?php

namespace App\Http\Controllers\Info;

use App\Http\Controllers\Controller;
use App\Models\ModulePage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InfoController extends Controller
{
    protected function renderPage(string $pageKey)
    {
        $page = ModulePage::with(['imageAttachments', 'fileAttachments', 'relatedLinks'])
            ->where('module', 'info')
            ->where('page_key', $pageKey)
            ->first();

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

        return view("info::{$bladeName}", [
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

    public function education()
    {
        return $this->renderPage('education');
    }
    public function structure()
    {
        return $this->renderPage('structure');
    }
    public function mtResources()
    {
        return $this->renderPage('mtResources');
    }
    public function paidServices()
    {
        return $this->renderPage('paidServices');
    }
    public function finance()
    {
        return $this->renderPage('finance');
    }
    public function vacancies()
    {
        return $this->renderPage('vacancies');
    }
    public function scholarships()
    {
        return $this->renderPage('scholarships');
    }
    public function catering()
    {
        return $this->renderPage('catering');
    }
    public function standards()
    {
        return $this->renderPage('standards');
    }
    public function accessibleEnvironment()
    {
        return $this->renderPage('accessibleEnvironment');
    }
    public function internationalCooperation()
    {
        return $this->renderPage('internationalCooperation');
    }
    public function sredneahtubinskBranch()
    {
        return $this->renderPage('sredneahtubinskBranch');
    }
}
