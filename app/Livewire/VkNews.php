<?php

namespace App\Livewire;

use App\Services\VkService;
use Livewire\Component;

class VkNews extends Component
{
    public $posts = [];

    public function mount(VkService $vk)
    {
        $this->posts = $vk->getPosts(20);
    }

    public function render()
    {
        return view('livewire.vk-news');
    }
}
