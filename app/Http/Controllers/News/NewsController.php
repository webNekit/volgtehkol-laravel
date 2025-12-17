<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\VkService;
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

    public function showVk(int $id, VkService $vk)
    {
        $posts = $vk->getPosts(100);

        $post = collect($posts)->firstWhere('id', $id);

        abort_if(!$post, 404);

        return view('news::vk-show', [
            'title' => 'Новость',
            'post'  => $post,
        ]);
    }
}
