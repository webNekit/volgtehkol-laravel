<?php

namespace App\Livewire\Ui;

use Livewire\Component;
use App\Models\Contact;
use App\Models\Section;

class Mobile extends Component
{
    public array $menu = [];
    public array $submenu = [];
    public array $contacts = [];

    public function mount()
    {
        // Основное меню (из конфига)
        $this->menu = config('menu');

        // 🔹 Опциональное меню (как в десктопе)
        $this->submenu = Section::where('status', true)
            ->with([
                'pages' => fn ($q) => $q->where('status', true),
            ])
            ->get()
            ->map(function ($section) {
                return [
                    'title' => $section->title,
                    'items' => $section->pages->map(function ($page) {
                        return [
                            'name' => $page->title,
                            'route' => 'common::show',
                            'params' => ['slug' => $page->slug],
                        ];
                    })->toArray(),
                ];
            })
            ->toArray();

        // Контакты
        $this->contacts = Contact::where('is_active', true)
            ->where('is_header', true)
            ->get()
            ->map(fn ($c) => [
                'type'  => $c->type,
                'value' => $c->value,
            ])
            ->toArray();
    }

    public function render()
    {
        return view('livewire.ui.mobile');
    }
}
