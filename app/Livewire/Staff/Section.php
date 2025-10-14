<?php

namespace App\Livewire\Staff;

use Livewire\Component;

class Section extends Component
{
    public $categories = [];
    public string $title = 'Сотрудники';

    public function mount($categories, string $title)
    {
        $this->categories = $categories;
        $this->title = $title;
    }

    public function render()
    {
        return view('livewire.staff.section', [
            'categories' => $this->categories,
            'title' => $this->title,
        ]);
    }
}
