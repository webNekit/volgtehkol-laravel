<?php

namespace App\Livewire\Ui;

use Livewire\Component;

class Header extends Component
{
    public array $menu = [];

    public function mount()
    {
        $this->menu = config('menu');
    }

    public function render()
    {
        return view('livewire.ui.header', [
            'menu' => $this->menu,
        ]);
    }
}
