<?php

namespace App\Livewire\Ui;

use Livewire\Component;

class Submenu extends Component
{
    public array $menu = [];

    public function mount()
    {
        $this->menu = config('submenu');
    }

    public function render()
    {
        return view('livewire.ui.submenu', [
            'submenu' => $this->menu,
        ]);
    }
}
