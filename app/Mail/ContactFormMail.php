<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use SerializesModels;

    public string $name;
    public string $email;
    public string $messageText;

    public function __construct(string $name, string $email, string $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->messageText = $message;
    }

    public function build()
    {
        return $this
            ->subject('Обратная связь с сайта колледжа')
            ->view('emails.contact-form');
    }
}
