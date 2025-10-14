<?php

namespace App\Livewire\News;

use App\Models\Article;
use Livewire\Component;

class Collection extends Component
{
    public function getArticlesProperty(): array
    {
        return [
            'articles' => Article::where('is_active', true)->orderBy('created_at', 'desc')->get(),
        ];
    }

    public function render()
    {
        return view('livewire.news.collection', [
            'articles' => $this->articles['articles'],
        ]);
    }
}
