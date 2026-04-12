<?php

namespace App\Livewire\Specials;

use Livewire\Component;

class Collection extends Component
{
    public array $specials = [];

    public function mount(array $specials)
    {
        $this->specials = $specials;
    }

    public function render()
    {
        return view('livewire.specials.collection', [
            'specials' => $this->specials['default'],
        ]);
    }
}
