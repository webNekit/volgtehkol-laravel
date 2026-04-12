<?php

namespace App\Livewire\Ui;

use App\Models\Section;
use Livewire\Component;

class Submenu extends Component
{
    public array $menu = [];

    public function mount()
    {
        $this->menu = Section::where('status', true)
            ->with(['pages' => fn($q) => $q->where('status', true)])
            ->get()
            ->map(function ($section) {
                return [
                    'title' => $section->title,
                    'items' => $section->pages->map(function ($page) {
                        return [
                            'name' => $page->title,
                            'url'  => route('common::show', $page->slug),
                        ];
                    })->toArray(),
                ];
            })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.ui.submenu', [
            'submenu' => $this->menu,
        ]);
    }
}
