<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionPreinscripcion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Propiedades públicas que estarán disponibles en tu plantilla.
     */
    public $preinscripcion;
    public $mensajeAdmin;
    public $titulo;

    /**
     * Crea una nueva instancia del mensaje.
     */
    public function __construct($preinscripcion, $mensajeAdmin = null)
    {
        $this->preinscripcion = $preinscripcion;
        $this->mensajeAdmin = $mensajeAdmin;
        switch (strtolower($this->preinscripcion['estatus'])) {
            case 'aceptado':
                $this->titulo = '¡Tu Preinscripción ha sido Aceptada!';
                break;
            case 'anulado':
                $this->titulo = '¡Tu Preinscripción ha sido Negada!';
            case 'negado': 
                $this->titulo = 'Actualización sobre tu Preinscripción';
                break;
            default: 
                $this->titulo = '¡Confirmación de Preinscripción!';
                break;
        }
    }

    /**
     * Define el sobre del mensaje (asunto, remitente).
     */
    public function envelope(): Envelope
    {
        // --- 3. CAMBIO PARA ASUNTO DINÁMICO ---
        // Ahora el asunto del correo cambiará automáticamente.
        return new Envelope(
            subject: $this->titulo . ' - Instituto CADI',
        );
    }

    /**
     * Define el contenido del mensaje (la plantilla a usar).
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.preinscripcion',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}