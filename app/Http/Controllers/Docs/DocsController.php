<?php

namespace App\Http\Controllers\Docs;

use App\Http\Controllers\Controller;
use App\Http\Resources\Docs\DocsResource;
use Illuminate\Http\Request;

class DocsController extends Controller
{
    public function index()
    {
        return view('docs::index', [
            'title_page' => 'Документы',
            'docs' => [
                'default' => DocsResource::docsCollection(),
            ],
        ]);
    }
}
