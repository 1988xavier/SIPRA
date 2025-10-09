<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AvisoAspiranteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $mensajePersonalizado;

    public function __construct($nombre, $mensajePersonalizado)
    {
        $this->nombre = $nombre;
        $this->mensajePersonalizado = $mensajePersonalizado;
    }

    public function build()
    {
        return $this->subject('Notificación de la Universidad Politécnica de Bacalar')
                    ->view('emails.aviso-aspirante');
    }
}
