<?php

namespace App\Livewire\Banner;

use App\Models\Article;
use Livewire\Component;
use App\Http\Resources\Events\EventsResource;

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
        return view('livewire.banner.section', [
            'eventsBanner' => $this->eventsBanner,
            'newsBanner' => $this->newsBanner,
        ]);
    }
}
