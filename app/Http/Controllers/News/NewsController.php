<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index() {
        return view('news::index');
    }

    public function show($slug) {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('news::show', [
            'title' => $article->title,
            'article' => $article,
        ]);
    }
}
