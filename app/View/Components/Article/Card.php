<?php

namespace App\View\Components\Article;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $article;
    public $limit;

    public function __construct($article, $limit = 280)
    {
        $this->article = $article;
        $this->limit = $limit;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.article.card');
    }
}
