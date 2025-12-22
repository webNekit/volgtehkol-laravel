<?php

namespace App\Livewire\Ui;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $message = '';

    // honeypot
    public string $website = '';

    // анти-бот таймер
    public int $startedAt;

    public bool $success = false;

    public function mount()
    {
        $this->startedAt = now()->timestamp;
    }

    protected function rules(): array
    {
        return [
            'name'    => 'required|min:2|max:100',
            'email'   => 'required|email',
            'message' => 'required|min:10|max:2000',
        ];
    }

    public function submit()
    {
        // ❌ honeypot
        if (!empty($this->website)) {
            return;
        }

        // ❌ слишком быстро — бот
        if (now()->timestamp - $this->startedAt < 3) {
            return;
        }

        $this->validate();

        Mail::to(config('mail.contact_receiver', env('CONTACT_RECEIVER_EMAIL')))
            ->send(new ContactFormMail(
                name: $this->name,
                email: $this->email,
                message: $this->message
            ));

        $this->reset(['name', 'email', 'message']);
        $this->success = true;
        $this->startedAt = now()->timestamp;
    }

    public function render()
    {
        return view('livewire.ui.contact-form');
    }
}
