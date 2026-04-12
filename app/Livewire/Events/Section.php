<?php

namespace App\Livewire\Events;

use Livewire\Component;

class Section extends Component
{
    public array $events = [];

    public function mount(array $events)
    {
        $this->events = $events;
    }

    public function render()
    {
        return view('livewire.events.section', [
            'events_default' => $this->events['default'],
            'events_slider' => $this->events['slider'],
        ]);
    }
}
