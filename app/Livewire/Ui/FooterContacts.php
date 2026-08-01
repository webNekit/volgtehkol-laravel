<?php

namespace App\Livewire\Ui;

use Livewire\Component;
use App\Models\Contact;

class FooterContacts extends Component
{
    public array $groups = [];

    public function mount()
    {
        $this->groups = Contact::with('departament')
            ->where('is_footer', true)
            ->where('is_active', true)
            ->get()
            ->groupBy('contact_departament_id')
            ->map(fn ($contacts) => [
                'title' => $contacts->first()->departament?->title,
                'items' => $contacts->map(fn ($c) => [
                    'type'  => $c->type,
                    'value' => $c->value,
                    'label' => $this->format($c),
                ])->values()->toArray(),
            ])
            ->values()
            ->toArray();
    }

    /**
     * Телефоны в базе хранятся цифрами (88442459138) — приводим к 8(8442) 45-91-38.
     */
    private function format(Contact $contact): string
    {
        $digits = preg_replace('/\D/', '', $contact->value);

        if ($contact->type !== 'phone' || strlen($digits) !== 11) {
            return $contact->value;
        }

        return sprintf(
            '%s(%s) %s-%s-%s',
            $digits[0],
            substr($digits, 1, 4),
            substr($digits, 5, 2),
            substr($digits, 7, 2),
            substr($digits, 9, 2),
        );
    }

    public function render()
    {
        return view('livewire.ui.footer-contacts', [
            'groups' => $this->groups,
        ]);
    }
}
