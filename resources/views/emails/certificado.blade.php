<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrega de Certificado</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap');
        body { font-family: 'Montserrat', Arial, sans-serif; background-color: #f4f5f7; margin: 0; padding: 20px 10px; }
        .email-container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); border: 1px solid #e9e9e9; }
        .header { background-color: #f9f9f9; padding: 30px; text-align: center; border-bottom: 1px solid #e9e9e9; }
        .header img { max-width: 160px; }
        .content { padding: 30px 40px; color: #3d4852; }
        .content h1 { font-size: 24px; font-weight: 700; color: #2f363d; margin: 0 0 10px 0; }
        .content p { line-height: 1.7; font-size: 16px; margin: 0 0 25px 0; }
        .card { background-color: #ffffff; border: 1px solid #e8e8e8; border-radius: 8px; padding: 25px; margin-top: 25px; border-top: 4px solid #F26522; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .card h2 { font-size: 18px; color: #2f363d; margin: 0 0 20px 0; font-weight: 700; display: flex; align-items: center; }
        .info-grid { font-size: 15px; line-height: 2; }
        .info-grid strong { color: #3d4852; font-weight: 700; }
        .cta-section { text-align: center; padding: 30px 0 10px 0; }
        .footer { text-align: center; padding: 30px; font-size: 12px; color: #95a0ab; }
        .footer p { margin: 5px 0; }
        .footer a { color: #F26522 !important; text-decoration: none; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ $message->embed(public_path('estilos/website/img/logo.png')) }}" alt="Logo Instituto CADI">
        </div>
        <div class="content">
            <h1>¡Felicidades por tu Logro!</h1>
            <p>Hola, <strong>{{ $datosCertificado['nombre_completo'] }}</strong>. En nombre de todo el equipo del Instituto CADI, queremos felicitarte por haber culminado exitosamente tu formación.</p>

            <div class="card">
                <h2>📜 Certificado Obtenido</h2>
                <div class="info-grid">
                    <strong>Curso Culminado:</strong> {{ $datosCertificado['nombre_curso'] }}<br>
                    <strong>Graduado(a):</strong> {{ $datosCertificado['nombre_completo'] }}<br>
                    <strong>Cédula:</strong> {{ $datosCertificado['cedula'] }}<br>
                    <strong>Fecha de Emisión:</strong> {{ $datosCertificado['fecha_graduacion'] }}
                </div>
            </div>

            <p style="margin-top: 30px; font-size: 15px; text-align: center; background-color: #f9f9f9; padding: 20px; border-radius: 8px;">
                Tu certificado digital ya está listo. Puedes descargarlo desde el botón a continuación. ¡Te deseamos el mayor de los éxitos en tu carrera profesional!
            </p>

            <div class="cta-section">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin: auto;">
                  <tr>
                    <td align="center" style="background:#F26522; border-radius:8px;">
                      <a href="{{ $datosCertificado['url_pdf'] }}" target="_blank" style="font-size: 16px; font-family: 'Montserrat', Arial, sans-serif; font-weight: bold; color: #ffffff; text-decoration: none; padding: 15px 35px; border-radius: 8px; display: inline-block;">
                        Descargar Certificado
                      </a>
                    </td>
                  </tr>
                </table>
            </div>
             <p style="text-align:center; font-size: 13px; color: #777; margin-top:15px;">
                PD: También hemos adjuntado una copia de tu certificado a este correo para tu conveniencia.
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Instituto CADI. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>