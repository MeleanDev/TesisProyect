<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Preinscripción</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap');
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            background-color: #f4f5f7;
            margin: 0;
            padding: 20px 10px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid #e9e9e9;
        }
        .header {
            background-color: #f9f9f9;
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid #e9e9e9;
        }
        .header img {
            max-width: 160px;
        }
        .content {
            padding: 30px 40px;
            color: #3d4852;
        }
        .content h1 {
            font-size: 24px;
            font-weight: 700;
            color: #2f363d;
            margin: 0 0 10px 0;
        }
        .content p {
            line-height: 1.7;
            font-size: 16px;
            margin: 0 0 25px 0;
        }
        
        .card {
            background-color: #ffffff;
            border: 1px solid #e8e8e8;
            border-radius: 8px;
            padding: 25px;
            margin-top: 25px;
            border-top: 4px solid #F26522;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .card h2 {
            font-size: 18px;
            color: #2f363d;
            margin: 0 0 20px 0;
            font-weight: 700;
            display: flex;
            align-items: center;
        }
        .info-grid {
            font-size: 15px;
            line-height: 2;
        }
        .info-grid strong {
            color: #3d4852;
            font-weight: 700;
        }
        .status {
            padding: 5px 15px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 13px;
            color: #fff;
            display: inline-block;
        }
        .status-recibido { background-color: #F26522; }
        .status-aceptado { background-color: #28a745; }
        .status-anulado { background-color: #dc3545; }
        .status-negado { background-color: #dc3545; } /* Añadido por si usas "negado" */

        /* --- ESTILO PARA LA TARJETA DEL MENSAJE DEL ADMIN --- */
        .card-mensaje {
            background-color: #fffaf0;
            border-left: 5px solid #F26522;
            border-radius: 8px;
            padding: 20px;
            margin-top: 25px;
            font-size: 15px;
            line-height: 1.6;
        }
        .card-mensaje h4 {
            margin: 0 0 10px 0;
            font-weight: 700;
            color: #2f363d;
            font-size: 16px;
        }
        .card-mensaje p {
            margin: 0;
            font-size: 15px;
        }

        .cta-section {
            text-align: center;
            padding: 30px 0 10px 0;
        }
        
        .footer {
            text-align: center;
            padding: 30px;
            font-size: 12px;
            color: #95a0ab;
        }
        .footer p { margin: 5px 0; }
        .footer a {
            color: #F26522 !important;
            text-decoration: none;
        }
        .preheader { display: none !important; visibility: hidden; opacity: 0; color: transparent; height: 0; width: 0; }
    </style>
</head>
<body>
    <span class="preheader">¡Tu preinscripción en el Instituto CADI ha sido confirmada!</span>

    <div class="email-container">
        <div class="header">
            <img src="{{ $message->embed(public_path('estilos/website/img/logo.png')) }}" alt="Logo Instituto CADI">
        </div>
        <div class="content">
            <h1>{{ $titulo }}</h1>

            <p>Hola, <strong>{{ $preinscripcion['nombres'] }}</strong>. Hemos recibido tu solicitud y estamos muy emocionados de que te unas a nuestra comunidad.</p>
            
            <div class="card">
                <h2>🎓 Detalles del Curso</h2>
                <div class="info-grid">
                    <strong>Curso:</strong> {{ $preinscripcion['nombre_curso'] }}<br>
                    <strong>Precio:</strong> {{ $preinscripcion['precio_curso'] }}<br>
                    <strong>Estatus:</strong> 
                    @php
                        $statusClass = 'status-recibido'; // Por defecto
                        $status = strtolower($preinscripcion['estatus']);
                        if ($status == 'aceptado') $statusClass = 'status-aceptado';
                        if ($status == 'anulado' || $status == 'negado') $statusClass = 'status-anulado';
                    @endphp
                    <span class="status {{ $statusClass }}">{{ ucfirst($preinscripcion['estatus']) }}</span>
                </div>
            </div>

            <div class="card">
                <h2>👤 Tu Información</h2>
                <div class="info-grid">
                    <strong>Nombre:</strong> {{ $preinscripcion['nombres'] }} {{ $preinscripcion['apellidos'] }}<br>
                    <strong>Cédula:</strong> {{ $preinscripcion['cedula'] }}<br>
                    <strong>Fecha de Registro:</strong> {{ $preinscripcion['fecha_registro'] }}
                </div>
            </div>

            @if (isset($mensajeAdmin) && !empty($mensajeAdmin))
                <div class="card-mensaje">
                    <h4>ℹ️ Mensaje del Administrador:</h4>
                    <p>{{ $mensajeAdmin }}</p>
                </div>
            @endif


            <p style="margin-top: 30px; font-size: 15px; text-align: center; background-color: #f9f9f9; padding: 20px; border-radius: 8px;">
                Nuestro equipo revisará tu solicitud a la brevedad. Por favor, mantente atento a tu correo electrónico, ya que te contactaremos por esta vía para informarte sobre los siguientes pasos.
            </p>

            <div class="cta-section">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin: auto;">
                  <tr>
                    <td align="center" style="background:#F26522; border-radius:8px;">
                      <a href="https://institutocadi.com" target="_blank" style="font-size: 16px; font-family: 'Montserrat', Arial, sans-serif; font-weight: bold; color: #ffffff; text-decoration: none; padding: 15px 35px; border-radius: 8px; display: inline-block;">
                        Visita Nuestro Sitio Web
                      </a>
                    </td>
                  </tr>
                </table>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Instituto CADI. Todos los derechos reservados.</p>
            <p>Este es un correo generado automáticamente. Por favor, no respondas a este mensaje.</p>
            <p><a href="https://institutocadi.com/contacto">Contacto</a> | <a href="https://institutocadi.com/politica-de-privacidad">Privacidad</a></p>
        </div>
    </div>
</body>
</html>