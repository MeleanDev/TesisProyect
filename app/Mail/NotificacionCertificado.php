<?php

namespace App\Mail;

use App\Models\Certificacion; // Importamos el modelo
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment; // Importante para adjuntar archivos
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class NotificacionCertificado extends Mailable
{
    use Queueable, SerializesModels;

    public $datosCertificado;
    protected $certificado;

    /**
     * Crea una nueva instancia del mensaje.
     */
    public function __construct(Certificacion $certificado)
    {
        $this->certificado = $certificado;
        $this->datosCertificado = [
            'nombre_completo' => $certificado->clienteRegistrado->Pnombre . ' ' . $certificado->clienteRegistrado->Papelldio,
            'cedula' => $certificado->clienteRegistrado->identidad,
            'nombre_curso' => $certificado->curso->nombre,
            'fecha_graduacion' => Carbon::now()->format('d/m/Y'),
            'url_pdf' => asset('storage/' . $certificado->pdfcertificado),
        ];
    }

    /**
     * Define el sobre del mensaje.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '¡Felicidades! Tu certificado del Instituto CADI ya está disponible',
        );
    }

    /**
     * Define el contenido del mensaje.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.certificado',
        );
    }

    /**
     * Define los archivos adjuntos del mensaje.
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath(storage_path('app/public/' . $this->certificado->pdfcertificado))
                ->as('Certificado-' . $this->certificado->curso->slug . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}