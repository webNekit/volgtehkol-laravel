<?php

namespace App\Livewire\Docs;

use Livewire\Component;

class Section extends Component
{
    public array $docs = [];
    public string $title = 'Страница';

    public function mount(array $docs, string $title)
    {
        $this->docs = $docs;
        $this->title = $title;
    }

    public function render()
    {
        return view('livewire.docs.section', [
            'title' => $this->title,
            'categories' => $this->docs['default'],
        ]);
    }
}
