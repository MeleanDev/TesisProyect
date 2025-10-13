<?php

namespace App\Mail;

use App\Models\Curso;
use App\Models\ClienteRegistrado;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // <-- ¡Importante para las colas!
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AnuncioNuevoCurso extends Mailable implements ShouldQueue // <-- ¡Importante!
{
    use Queueable, SerializesModels;

    public $curso;
    public $cliente;

    /**
     * Crea una nueva instancia del mensaje.
     */
    public function __construct(Curso $curso, ClienteRegistrado $cliente)
    {
        $this->curso = $curso;
        $this->cliente = $cliente;
    }

    /**
     * Define el sobre del mensaje.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '¡Nuevo Curso en CADI! ' . $this->curso->nombre,
        );
    }

    /**
     * Define el contenido del mensaje.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.anuncio_curso',
        );
    }

    /**
     * Get the attachments for the message.
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}