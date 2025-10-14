<?php

namespace App\Livewire\Ui;

use Livewire\Component;
use App\Models\Contact;

class HeaderContacts extends Component
{
    public array $contacts = [];

    public function mount()
    {
        $this->contacts = Contact::where('is_header', true)
            ->where('is_active', true)
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.ui.header-contacts', [
            'contacts' => $this->contacts,
        ]);
    }
}
