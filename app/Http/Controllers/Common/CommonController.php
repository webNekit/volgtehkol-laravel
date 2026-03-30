<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function show($slug)
    {
        $page = Page::with(['section', 'imageAttachments', 'fileAttachments', 'relatedLinks'])
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('common::show', [
            'title' => $page->title,
            'content' => $page->content,
            'images' => $page->imageAttachments,
            'files' => $page->fileAttachments,
            'links' => $page->relatedLinks,
        ]);
    }
}
