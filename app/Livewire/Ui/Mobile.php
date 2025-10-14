<?php

namespace App\Livewire\Ui;

use Livewire\Component;
use App\Models\Contact;

class Mobile extends Component
{
    public array $menu = [];
    public array $submenu = [];
    public array $contacts = [];

    public function mount()
    {
        $this->menu = config('menu');
        $this->submenu = config('submenu');

        // Загружаем активные контакты для шапки и мобильного меню
        $this->contacts = Contact::where('is_active', true)
            ->where('is_header', true)
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.ui.mobile', [
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'contacts' => $this->contacts,
        ]);
    }
}
