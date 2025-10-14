<?php

namespace App\Livewire\Specials;

use Livewire\Component;

class Section extends Component
{
    public array $specials = [];

    public function mount(array $specials)
    {
        $this->specials = $specials;
    }

    public function render()
    {
        return view('livewire.specials.section', [
            'specials_default' => $this->specials['default'] ?? [],
        ]);
    }
}
