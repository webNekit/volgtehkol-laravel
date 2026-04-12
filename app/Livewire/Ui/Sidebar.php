<?php

namespace App\Livewire\Ui;

use App\Models\Page;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Sidebar extends Component
{
    public array $menu = []; // ссылки для текущего раздела

    public function mount()
    {
        // Определяем текущий раздел
        $currentRoute = Route::current();
        $currentPrefix = $currentRoute?->getPrefix(); // префикс статических маршрутов
        $currentSlug = request()->route('slug');     // slug для динамических страниц

        // --------------------------
        // 1. СТАТИЧЕСКИЕ ССЫЛКИ
        // --------------------------
        $menus = config('menu', []);

        $this->menu = collect($menus)
            ->where('prefix', ltrim($currentPrefix, '/')) // фильтр по текущему разделу
            ->pluck('items')
            ->flatten(1)
            ->map(fn($item) => [
                'name' => $item['name'],
                'route' => $item['route'] ?? '#!',
                'params' => $item['params'] ?? [],
                'is_static' => true,
            ])
            ->toArray();

        // --------------------------
        // 2. ДИНАМИЧЕСКИЕ СТРАНИЦЫ
        // --------------------------
        if ($currentSlug) {
            $page = Page::with('section.pages')
                ->where('slug', $currentSlug)
                ->first();

            if ($page && $page->section) {
                foreach ($page->section->pages->where('status', true) as $p) {
                    $this->menu[] = [
                        'name' => $p->title,
                        'url' => route('common::show', ['slug' => $p->slug]),
                        'slug' => $p->slug,
                        'is_static' => false,
                    ];
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.ui.sidebar', [
            'menu' => $this->menu,
        ]);
    }
}
