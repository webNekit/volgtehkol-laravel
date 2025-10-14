<?php

namespace App\Livewire\Ui;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Sidebar extends Component
{
    public array $menu = [];

    public function mount()
    {
        $currentRoute = Route::current();
        $currentPrefix = $currentRoute?->getPrefix();

        $menus = config('menu');

        $this->menu = collect($menus)->firstWhere('prefix', ltrim($currentPrefix, '/')) ?? [];
    }

    public function render()
    {
        return view('livewire.ui.sidebar');
    }
}
