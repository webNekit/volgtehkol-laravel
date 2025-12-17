<?php

namespace App\Livewire;

use App\Services\VkService;
use Livewire\Component;

class VkNews extends Component
{
    public array $sliderPosts = [];
    public array $cardPosts   = [];

    public function mount(VkService $vk)
    {
        // 7 в слайдер + 4 в карточки
        $posts = collect($vk->getPosts(11));

        $this->sliderPosts = $posts->take(7)->values()->toArray();
        $this->cardPosts   = $posts->skip(7)->take(4)->values()->toArray();
    }

    public function render()
    {
        return view('livewire.vk-news');
    }
}
