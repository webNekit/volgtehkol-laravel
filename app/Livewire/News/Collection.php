<?php

namespace App\Livewire\News;

use App\Services\VkService;
use Livewire\Component;

class Collection extends Component
{
    public array $posts = [];
    public int $limit = 12;
    public int $offset = 0;
    public bool $hasMore = true;

    public function mount(VkService $vk)
    {
        $this->loadPosts($vk);
    }

    public function loadMore(VkService $vk)
    {
        $this->offset += $this->limit;
        $this->loadPosts($vk);
    }

    protected function loadPosts(VkService $vk): void
    {
        $newPosts = $vk->getPosts($this->limit, $this->offset);

        if (count($newPosts) < $this->limit) {
            $this->hasMore = false;
        }

        $this->posts = array_merge($this->posts, $newPosts);
    }

    public function render()
    {
        return view('livewire.news.collection');
    }
}
