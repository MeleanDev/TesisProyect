<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anuncio de Nuevo Curso</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap');
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
        }
        .header {
            padding: 30px;
            text-align: center;
        }
        .header img.logo {
            max-width: 140px;
        }
        .content {
            padding: 10px 40px 40px 40px;
            color: #3d4852;
            text-align: center;
        }
        .course-title {
            font-size: 28px;
            font-weight: 800;
            color: #2f363d;
            margin: 0 0 10px 0;
            line-height: 1.3;
        }
        .course-subtitle {
            font-size: 16px;
            color: #F26522;
            margin: 0 0 30px 0;
            font-weight: 700;
        }
        .hero-image {
            width: 100%;
            height: auto;
            border-radius: 12px;
            display: block;
            margin-bottom: 30px;
        }
        .course-description {
            font-size: 16px;
            line-height: 1.7;
            text-align: left;
            margin-bottom: 30px;
        }
        .divider {
            border: 0;
            height: 1px;
            background-color: #e8e8e8;
            margin: 30px 0;
        }
        .details-grid {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            margin: 20px 0;
        }
        .details-grid td {
            width: 50%;
            padding: 10px;
            font-size: 15px;
            vertical-align: top;
        }
        .details-grid .icon {
            font-size: 20px;
            vertical-align: middle;
            padding-right: 10px;
        }
        .cta-prompt {
            font-size: 18px;
            font-weight: 700;
            color: #2f363d;
            margin: 40px 0 20px 0;
        }
        .footer {
            text-align: center;
            padding: 30px;
            font-size: 12px;
            color: #95a0ab;
            background-color: #f9f9f9;
        }
        .footer p { margin: 5px 0; }
        .footer a { color: #F26522 !important; text-decoration: underline; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img class="logo" src="{{ $message->embed(public_path('estilos/website/img/logo.png')) }}" alt="Logo Instituto CADI">
        </div>
        <div class="content">
            <h1 class="course-title">{{ $curso->nombre }}</h1>
            <p class="course-subtitle">Una nueva oportunidad para impulsar tu carrera</p>

            <a href="{{ url('cursos/' . $curso->slug) }}" target="_blank">
                <img class="hero-image" src="{{ $curso->image_url }}" alt="Imagen de {{ $curso->nombre }}">
            </a>

            <p class="course-description">
                Hola, <strong>{{ $cliente->Pnombre }}</strong>.
                <br><br>
                Estamos emocionados de presentarte nuestra más reciente formación, diseñada especialmente para profesionales como tú que buscan crecer y destacar en el mercado actual.
                <br><br>
                {{ $curso->descripcion }}
            </p>

            <hr class="divider">

            <table class="details-grid" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <span class="icon">💻</span>
                        <strong>Modalidad:</strong> {{ $curso->modalidad }}
                    </td>
                    <td>
                        <span class="icon">⏰</span>
                        <strong>Duración:</strong> {{ $curso->horasAcademicas }} horas
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="icon">🎓</span>
                        <strong>Certificación:</strong> {{ $curso->certificacion }}
                    </td>
                    <td>
                        <span class="icon">💵</span>
                        <strong>Inversión:</strong> {{ $curso->precio }}
                    </td>
                </tr>
            </table>

            <p class="cta-prompt">¿Listo para dar el siguiente paso?</p>
            
            <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin: auto;">
              <tr>
                <td align="center" style="background:#F26522; border-radius:8px;">
                  <a href="{{ url('cursos/' . $curso->slug) }}" target="_blank" style="font-size: 16px; font-family: 'Montserrat', Arial, sans-serif; font-weight: bold; color: #ffffff; text-decoration: none; padding: 15px 35px; border-radius: 8px; display: inline-block;">
                    Conoce Más y Preinscríbete
                  </a>
                </td>
              </tr>
            </table>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Instituto CADI. Todos los derechos reservados.</p>
            <p>Recibes este correo porque estás registrado en nuestra plataforma.</p>
            <p><a href="#">Cancelar suscripción</a></p>
        </div>
    </div>
</body>
</html>