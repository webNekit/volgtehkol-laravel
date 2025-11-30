<?php

namespace App\Livewire\Video;

use App\Http\Resources\Events\EventsResource;
use App\Models\Article;
use Livewire\Component;

class Section extends Component
{
    public $eventsBanner;
    public $newsBanner;

    public function mount()
    {
        $this->eventsBanner = EventsResource::eventsBannerCollection();
        $this->newsBanner = Article::query()
            ->where('is_active', true)
            ->where('is_banner', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.video.section',  [
            'eventsBanner' => $this->eventsBanner,
            'newsBanner' => $this->newsBanner,
        ]);
    }
}
