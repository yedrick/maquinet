<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $link;

    /**
     * Create a new message instance.
     */
    public function __construct($nombre, $link)
    {
        $this->nombre = $nombre;
        $this->link = $link;
    }

    public function build()
    {
        return $this
            ->subject('Gracias por participar')
            ->view('emails.confirmacion');
    }
}
