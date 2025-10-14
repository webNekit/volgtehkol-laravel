<?php

namespace App\Livewire\Ui;

use Livewire\Component;

class Footer extends Component
{
    public array $menu = [];

    public function mount()
    {
        $this->menu = config('menu');
    }

    public function render()
    {
        return view('livewire.ui.footer', [
            'menu' => $this->menu,
        ]);
    }
}
