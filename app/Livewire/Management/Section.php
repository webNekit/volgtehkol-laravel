<?php

namespace App\Livewire\Management;

use Livewire\Component;

class Section extends Component
{
    public $categories = [];
    public string $title = 'Руководство';

    public function mount($categories, string $title)
    {
        $this->categories = $categories;
        $this->title = $title;
    }

    public function render()
    {
        return view('livewire.management.section', [
            'categories' => $this->categories,
            'title' => $this->title,
        ]);
    }
}
