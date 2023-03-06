<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Personalize extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return Personalize
     */
    public function build()
    : Personalize
    {
        return $this
            ->from($this->data['sender_email'])
            ->subject('Richiedi la scatola personalizzata qui')
            ->markdown('emails.personalizes');
    }
}
