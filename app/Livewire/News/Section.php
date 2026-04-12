<?php

namespace App\Livewire\News;

use App\Models\Article;
use Livewire\Component;

class Section extends Component
{
    public function getArticlesProperty() {
        return [
            'articles' => Article::where('is_active', true)->where('is_slider', false)->where('is_banner', false)->orderBy('created_at', 'desc')->limit(4)->get(),
            'articles_slider' => Article::where('is_active', true)->where('is_slider', true)->where('is_banner', false)->orderBy('created_at', 'desc')->get(),
        ];
    }

    public function render()
    {
        return view('livewire.news.section', [
            'articles' => $this->articles['articles'],
            'articles_slider' => $this->articles['articles_slider'],
        ]);
    }
}
